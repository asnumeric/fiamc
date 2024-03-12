@extends('layouts.app')
@section('page-title')
    {{traineePrefix().$traineeDetail->id}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('classes.index')}}">{{__('Classes')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{traineePrefix().$traineeDetail->id}} {{__('Details')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>  {{traineePrefix().$traineeDetail->id}} {{__('Details')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Name')}}</h6>
                                <p class="mb-20">{{$trainee->name}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Email')}}</h6>
                                <p class="mb-20">{{$trainee->email}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Phone Number')}}</h6>
                                <p class="mb-20">{{$trainee->phone_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Date of Birth')}}</h6>
                                <p class="mb-20">{{dateFormat($traineeDetail->dob)}} </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Gender')}}</h6>
                                <p class="mb-20">{{$traineeDetail->gender}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Age')}}</h6>
                                <p class="mb-20">{{$traineeDetail->age}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Country')}}</h6>
                                <p class="mb-20">{{$traineeDetail->country}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('State')}}</h6>
                                <p class="mb-20">{{$traineeDetail->state}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('City')}}</h6>
                                <p class="mb-20">{{$traineeDetail->city}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Zip Code')}}</h6>
                                <p class="mb-20">{{$traineeDetail->zip_code}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Address')}}</h6>
                                <p class="mb-20">{{$traineeDetail->address}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Class')}}</h6>
                                <p class="mb-20">
                                    @foreach($trainee->classAssign() as $class)
                                        {{$class}}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Category')}}</h6>
                                <p class="mb-20">{{ !empty($traineeDetail->categorys)?$trainee->traineeDetail->categorys->title:'-' }} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Trainer')}}</h6>
                                <p class="mb-20">{{ !empty($traineeDetail->trainers)?$traineeDetail->trainers->name:'-'}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Fitness Goal')}}</h6>
                                <p class="mb-20">{{ $traineeDetail->fitness_goal}} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Membership')}}</h6>
                                <p class="mb-20">{{ !empty($trainee->traineeDetail)?!empty($trainee->traineeDetail->membership)?$trainee->traineeDetail->membership->title:'-':'-' }} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Membership Start Date')}}</h6>
                                <p class="mb-20">{{ !empty($trainee->traineeDetail)?!empty($trainee->traineeDetail->membership_expiry_date)?dateFormat($trainee->traineeDetail->membership_expiry_date):__('Lifetime'):'-' }}  </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Membership Expiry Date')}}</h6>
                                <p class="mb-20">{{ !empty($trainee->traineeDetail)?!empty($trainee->traineeDetail->membership_expiry_date)?dateFormat($trainee->traineeDetail->membership_expiry_date):__('Lifetime'):'-' }}  </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    {{--    <div class="row">--}}
    {{--        <div class="col-xxl-12 cdx-xxl-100">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h4>{{__('Assign Trainee')}}</h4>--}}
    {{--                </div>--}}
    {{--                <div class="card-body">--}}
    {{--                    <div class="table-responsive">--}}
    {{--                        <table class="display dataTable cell-border datatbl-advance">--}}
    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th>{{__('ID')}}</th>--}}
    {{--                                <th>{{__('Name')}}</th>--}}
    {{--                                <th>{{__('Email')}}</th>--}}
    {{--                                <th>{{__('Phone Number')}}</th>--}}
    {{--                                <th>{{__('Membership')}}</th>--}}
    {{--                                <th>{{__('Membership Start Date')}}</th>--}}
    {{--                                <th>{{__('Membership Expiry Date')}}</th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}

    {{--                            @foreach ($trainees as $trainee)--}}

    {{--                                <tr>--}}
    {{--                                    <td>{{ traineePrefix().$trainee->trainee_id }} </td>--}}
    {{--                                    <td class="table-user">--}}
    {{--                                        <img--}}
    {{--                                            src="{{!empty($trainee->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"--}}
    {{--                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">--}}
    {{--                                        <a href="#"--}}
    {{--                                           class="text-body font-weight-semibold">{{ $trainee->userDetail->name }}</a>--}}
    {{--                                    </td>--}}
    {{--                                    <td>{{ !empty($trainee->userDetail->email)?$trainee->userDetail->email:'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->userDetail->phone_number)?$trainee->userDetail->phone_number:'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->membership)?$trainee->membership->title:'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->membership_start_date)?dateFormat($trainee->membership_start_date):'-' }} </td>--}}
    {{--                                    <td>{{ !empty($trainee->membership_expiry_date)?dateFormat($trainee->membership_expiry_date):__('Lifetime') }} </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
