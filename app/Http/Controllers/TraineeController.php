<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClassAssign;
use App\Models\Classes;
use App\Models\Membership;
use App\Models\Subscription;
use App\Models\TraineeDetail;
use App\Models\TrainerDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class TraineeController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage trainee')) {
            $trainees = User::where('parent_id', parentId())->where('type', 'trainee')->get();
            return view('trainee.index', compact('trainees'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

    }


    public function create()
    {
        $gender=User::$gender;
        $trainer=User::where('parent_id',parentId())->where('type','trainer')->get()->pluck('name','id');
        $trainer->prepend(__('Select Trainer'),'');

        $category=Category::where('parent_id',parentId())->get()->pluck('title','id');
        $category->prepend(__('Select Category'),'');

        $classes=Classes::where('parent_id',parentId())->get()->pluck('title','id');
        $classes->prepend(__('Select Class'),'');

        $membership=Membership::where('parent_id',parentId())->get()->pluck('title','id');
        $membership->prepend(__('Select Membership'),'');

        return view('trainee.create',compact('gender','trainer','category','classes','membership'));
    }


    public function store(Request $request)
    {

        if (\Auth::user()->can('create user')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'dob' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'category' => 'required',
                    'membership_plan' => 'required',
                    'fitness_goal' => 'required',
                    'membership_start_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalTrainee = $authUser->totalTrainee();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalTrainee >= $subscription->trainee_limit && $subscription->trainee_limit != 0) {
                return redirect()->back()->with('error', __('Your user limit is over, please upgrade your subscription.'));
            }

            $userRole =Role::where('parent_id',parentId())->where('name','trainee')->first();
            $trainee = new User();
            $trainee->name = $request->name;
            $trainee->email = $request->email;
            $trainee->phone_number = $request->phone_number;
            $trainee->password = \Hash::make(123456);
            $trainee->type = !empty($userRole->name)?$userRole->name:'trainee';
            $trainee->profile = 'avatar.png';
            $trainee->lang = 'english';
            $trainee->parent_id = parentId();
            $trainee->save();

            $trainee->assignRole($userRole);

            $expiryDate=Membership::calculateExpiryDate($request->membership_start_date,$request->membership_plan);
            if(!empty($trainee)){
                $traineeDetail = new TraineeDetail();
                $traineeDetail->user_id = $trainee->id;
                $traineeDetail->trainee_id =  $this->traineeNumber();
                $traineeDetail->dob = $request->dob;
                $traineeDetail->gender = $request->gender;
                $traineeDetail->age = $request->age;
                $traineeDetail->category = $request->category;
                $traineeDetail->trainer_assign = !empty($request->trainer_assign)?$request->trainer_assign:0;
                $traineeDetail->fitness_goal = !empty($request->fitness_goal)?$request->fitness_goal:'';
                $traineeDetail->country = !empty($request->country)?$request->country:'';
                $traineeDetail->state = !empty($request->state)?$request->state:'';
                $traineeDetail->city = !empty($request->city)?$request->city:'';
                $traineeDetail->zip_code = !empty($request->zip_code)?$request->zip_code:'';
                $traineeDetail->address = !empty($request->address)?$request->address:'';
                $traineeDetail->membership_plan = $request->membership_plan;
                $traineeDetail->membership_start_date = $request->membership_start_date;
                $traineeDetail->membership_expiry_date = $expiryDate;
                $traineeDetail->parent_id = parentId();
                $traineeDetail->save();
            }

            if(!empty($request->assign_class)){
                $class=new ClassAssign();
                $class->classes_id = $request->assign_class;
                $class->assign_id = $trainee->id;
                $class->assign_type = 'trainee';
                $class->save();

            }
            return redirect()->route('trainees.index')->with('success', __('Trainee successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($ids)
    {
        $id=Crypt::decrypt($ids);
        $trainee=User::find($id);
        $traineeDetail=TraineeDetail::where('user_id',$id)->first();

        return view('trainee.show',compact('trainee','traineeDetail'));
    }


    public function edit($id)
    {
        $trainer=User::where('parent_id',parentId())->where('type','trainer')->get()->pluck('name','id');
        $trainer->prepend(__('Select Trainer'),'');

        $gender=User::$gender;
        $trainee=User::find($id);

        $category=Category::where('parent_id',parentId())->get()->pluck('title','id');
        $category->prepend(__('Select Category'),'');

        $membership=Membership::where('parent_id',parentId())->get()->pluck('title','id');
        $membership->prepend(__('Select Membership'),'');
        return view('trainee.edit',compact('trainee','gender','trainer','category','membership'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit trainee')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'dob' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'category' => 'required',
                    'membership_plan' => 'required',
                    'fitness_goal' => 'required',
                    'membership_start_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $userRole =Role::where('parent_id',parentId())->where('name','trainee')->first();
            $trainee = User::findOrFail($id);
            $trainee->name = $request->name;
            $trainee->email = $request->email;
            $trainee->phone_number = $request->phone_number;
            $trainee->type = !empty($userRole->name)?$userRole->name:'trainee';
            $trainee->save();
            $trainee->assignRole($userRole);

            $expiryDate=Membership::calculateExpiryDate($request->membership_start_date,$request->membership_plan);
            if(!empty($trainee)){
                $traineeDetail = TraineeDetail::where('user_id',$id)->first();
                $traineeDetail->dob = $request->dob;
                $traineeDetail->gender = $request->gender;
                $traineeDetail->age = $request->age;
                $traineeDetail->trainer_assign = !empty($request->trainer_assign)?$request->trainer_assign:0;
                $traineeDetail->fitness_goal = !empty($request->fitness_goal)?$request->fitness_goal:'';
                $traineeDetail->country = !empty($request->country)?$request->country:'';
                $traineeDetail->state = !empty($request->state)?$request->state:'';
                $traineeDetail->city = !empty($request->city)?$request->city:'';
                $traineeDetail->zip_code = !empty($request->zip_code)?$request->zip_code:'';
                $traineeDetail->address = !empty($request->address)?$request->address:'';
                $traineeDetail->category = $request->category;
                $traineeDetail->membership_plan = $request->membership_plan;
                $traineeDetail->membership_start_date = $request->membership_start_date;
                $traineeDetail->membership_expiry_date = $expiryDate;
                $traineeDetail->save();
            }

            return redirect()->route('trainees.index')->with('success', 'Trainee successfully updated.');
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete trainee') ) {
            $trainee = User::find($id);
            $trainee->delete();
            if(!empty($trainee)) {
                $trainerDetail = TraineeDetail::where('user_id', $id)->first();
                $trainerDetail->delete();
            }

            ClassAssign::where('assign_id',$id)->delete();
            return redirect()->route('trainees.index')->with('success', __('Trainee successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    function traineeNumber()
    {
        $latest = TraineeDetail::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->trainee_id + 1;
    }
}
