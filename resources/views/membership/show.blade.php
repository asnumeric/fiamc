@extends('layouts.app')
@section('page-title')
    {{$membership->title}} {{__('Details')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('membership.index')}}">{{__('Membership')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{$membership->title}} {{__('Details')}}
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
                    <h4> {{$membership->title}}</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Title')}}</h6>
                                <p class="mb-20">{{$membership->title}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Package')}}</h6>
                                <p class="mb-20">{{$membership->package }} </p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Amount')}}</h6>
                                <p class="mb-20"> {{ priceFormat($membership->amount) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Class')}}</h6>
                                <p class="mb-20">
                                    @if(!empty($membership->classes_id))
                                        @foreach($membership->claases() as $class )
                                            {{ $class->title }}<br>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6>{{__('Notes')}}</h6>
                                <p class="mb-20"> {{ $membership->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-xxl-12 cdx-xxl-100">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Trainee')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display dataTable cell-border datatbl-advance">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone Number')}}</th>
                                <th>{{__('Membership Start Date')}}</th>
                                <th>{{__('Membership Expiry Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($trainees as $trainee)

                                <tr>
                                    <td>{{ traineePrefix().$trainee->trainee_id }} </td>
                                    <td class="table-user">
                                        <img
                                            src="{{!empty($trainee->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#"
                                           class="text-body font-weight-semibold">{{ $trainee->userDetail->name }}</a>
                                    </td>
                                    <td>{{ !empty($trainee->userDetail->email)?$trainee->userDetail->email:'-' }} </td>
                                    <td>{{ !empty($trainee->userDetail->phone_number)?$trainee->userDetail->phone_number:'-' }} </td>
                                    <td>{{ !empty($trainee->membership_start_date)?dateFormat($trainee->membership_start_date):'-' }} </td>
                                    <td>{{ !empty($trainee->membership_expiry_date)?dateFormat($trainee->membership_expiry_date):__('Lifetime') }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
