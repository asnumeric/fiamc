<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage attendance')) {
            $attendances = Attendance::where('parent_id', parentId())->get();
            return view('attendance.index', compact('attendances'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
        $users->prepend(__('Select Trainee'), '');

        return view('attendance.create', compact('users'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create attendance')) {
            $validator = \Validator::make(
                $request->all(), [
                    'user_id' => 'required',
                    'date' => 'required',
                    'checked_in_time' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $attendance = new Attendance();
            $attendance->user_id = $request->user_id;
            $attendance->date = $request->date;
            $attendance->checked_in_time = $request->checked_in_time;
            $attendance->checked_out_time = $request->checked_out_time;
            $attendance->notes = $request->notes;
            $attendance->parent_id = parentId();
            $attendance->save();

            return redirect()->route('attendances.index')->with('success', __('Attendance successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Attendance $attendance)
    {
        //
    }


    public function edit(Attendance $attendance)
    {

        $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
        $users->prepend(__('Select Trainee'), '');

        return view('attendance.edit', compact('users','attendance'));
    }


    public function update(Request $request, Attendance $attendance)
    {
        if (\Auth::user()->can('edit attendance')) {
            $validator = \Validator::make(
                $request->all(), [
                    'user_id' => 'required',
                    'date' => 'required',
                    'checked_in_time' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $attendance->user_id = $request->user_id;
            $attendance->date = $request->date;
            $attendance->checked_in_time = $request->checked_in_time;
            $attendance->checked_out_time = $request->checked_out_time;
            $attendance->notes = $request->notes;
            $attendance->save();

            return redirect()->route('attendances.index')->with('success', __('Attendance successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Attendance $attendance)
    {
        if (\Auth::user()->can('delete attendance')) {
            $attendance->delete();
            return redirect()->route('attendances.index')->with('success', __('Attendance successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function todayAttendance()
    {
        if (\Auth::user()->can('manage today attendance')) {
            $attendances = Attendance::where('parent_id', parentId())->where('date',date('Y-m-d'))->get();
            return view('attendance.today', compact('attendances'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
