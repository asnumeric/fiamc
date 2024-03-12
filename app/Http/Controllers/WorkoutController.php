<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WorkoutController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage workout')) {
            $workouts = Workout::where('parent_id', parentId())->get();
            return view('workout.index', compact('workouts'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $classes = Classes::where('parent_id', parentId())->get()->pluck('title', 'id');
        $classes->prepend(__('Select Class'), '');
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        $trainee->prepend(__('Select Trainee'), '');
        $activity = WorkoutActivity::where('parent_id', parentId())->get()->pluck('title', 'id');
        $days = Classes::$days;
        return view('workout.create', compact('trainee', 'classes', 'activity', 'days'));
    }


    public function store(Request $request)
    {

        if (\Auth::user()->can('create workout')) {
            $validator = \Validator::make(
                $request->all(), [
                    'assign_to' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $workout = new Workout();
            $workout->assign_to = $request->assign_to;
            $workout->assign_id = !empty($request->trainee) ? $request->trainee : $request->class;
            $workout->start_date = $request->start_date;
            $workout->end_date = $request->end_date;
            $workout->notes = $request->notes;

            $workout->parent_id = parentId();

            if (!empty($request->days)) {
                $activity = $request->activity;
                $weight = $request->weight;
                $sets = $request->sets;
                $reps = $request->reps;
                $rest = $request->rest;
                $workouts = [];
                foreach ($request->days as $key => $day) {
                    $data['days'] = $day;
                    $data['activity'] = $activity[$key];
                    $data['weight'] = $weight[$key];
                    $data['sets'] = $sets[$key];
                    $data['reps'] = $reps[$key];
                    $data['rest'] = $rest[$key];
                    $workouts[] = $data;
                }
                $workout->workout_history = json_encode($workouts);
            }

            $workout->save();

            return redirect()->route('workouts.index')->with('success', __('Workout successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        $workout=Workout::find(Crypt::decrypt($id));
        $histories=!empty($workout->workout_history)?json_decode($workout->workout_history):[];
        if (\Auth::user()->can('show workout')) {
            return view('workout.show', compact('workout','histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit(Workout $workout)
    {
        $classes = Classes::where('parent_id', parentId())->get()->pluck('title', 'id');
        $classes->prepend(__('Select Class'), '');
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        $trainee->prepend(__('Select Trainee'), '');
        $activity = WorkoutActivity::where('parent_id', parentId())->get()->pluck('title', 'id');
        $days = Classes::$days;
        $workoutHistory = !empty($workout->workout_history) ? json_decode($workout->workout_history) : [];
        return view('workout.edit', compact('trainee', 'classes', 'workout', 'activity', 'days', 'workoutHistory'));
    }


    public function update(Request $request, Workout $workout)
    {
        if (\Auth::user()->can('edit workout')) {
            $validator = \Validator::make(
                $request->all(), [
                    'assign_to' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $workout->assign_to = $request->assign_to;
            $workout->assign_id = !empty($request->trainee) ? $request->trainee : $request->class;
            $workout->start_date = $request->start_date;
            $workout->end_date = $request->end_date;
            $workout->notes = $request->notes;
            $workout->parent_id = parentId();

            if (!empty($request->days)) {
                $activity = $request->activity;
                $weight = $request->weight;
                $sets = $request->sets;
                $reps = $request->reps;
                $rest = $request->rest;
                $workouts = [];
                foreach ($request->days as $key => $day) {
                    $data['days'] = $day;
                    $data['activity'] = $activity[$key];
                    $data['weight'] = $weight[$key];
                    $data['sets'] = $sets[$key];
                    $data['reps'] = $reps[$key];
                    $data['rest'] = $rest[$key];
                    $workouts[] = $data;
                }
                $workout->workout_history = json_encode($workouts);
            }

            $workout->save();

            return redirect()->route('workouts.index')->with('success', __('Workout successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Workout $workout)
    {
        if (\Auth::user()->can('delete workout')) {
            $workout->delete();
            return redirect()->route('workouts.index')->with('success', __('Workout successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function todayWorkout()
    {
        if (\Auth::user()->can('manage today workout')) {
            $workouts = Workout::where('parent_id', parentId())->where('assign_to','trainee')->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
            return view('workout.today', compact('workouts'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
