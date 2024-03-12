
{{ Form::model($trainee, array('route' => array('trainees.update', $trainee->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('name',__('Name'),array('class'=>'form-label')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('email',__('Email'),array('class'=>'form-label'))}}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter email'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('phone_number',__('Phone Number'),array('class'=>'form-label')) }}
            {{Form::text('phone_number',null,array('class'=>'form-control','placeholder'=>__('Enter phone number'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('dob',__('Date of Birth'),array('class'=>'form-label')) }}
            {{Form::date('dob',!empty($trainee->traineeDetail)?$trainee->traineeDetail->dob:null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('age',__('Age'),array('class'=>'form-label')) }}
            {{Form::number('age',!empty($trainee->traineeDetail)?$trainee->traineeDetail->age:null,array('class'=>'form-control','placeholder'=>__('Enter age'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('gender',__('Gender'),array('class'=>'form-label')) }}
            {!! Form::select('gender', $gender, !empty($trainee->traineeDetail)?$trainee->traineeDetail->gender:null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('country',__('Country'),array('class'=>'form-label')) }}
            {{Form::text('country',!empty($trainee->traineeDetail)?$trainee->traineeDetail->country:null,array('class'=>'form-control','placeholder'=>__('Enter country')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('state',__('State'),array('class'=>'form-label')) }}
            {{Form::text('state',!empty($trainee->traineeDetail)?$trainee->traineeDetail->state:null,array('class'=>'form-control','placeholder'=>__('Enter state')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('city',__('City'),array('class'=>'form-label')) }}
            {{Form::text('city',!empty($trainee->traineeDetail)?$trainee->traineeDetail->city:null,array('class'=>'form-control','placeholder'=>__('Enter city')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('zip_code',__('Zip Code'),array('class'=>'form-label')) }}
            {{Form::text('zip_code',!empty($trainee->traineeDetail)?$trainee->traineeDetail->zip_code:null,array('class'=>'form-control','placeholder'=>__('Enter zip code')))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('address',__('Address'),array('class'=>'form-label')) }}
            {{Form::textarea('address',!empty($trainee->traineeDetail)?$trainee->traineeDetail->address:null,array('class'=>'form-control','rows'=>1,'placeholder'=>__('Enter address')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('fitness_goal',__('Fitness Goal'),array('class'=>'form-label')) }}
            {{Form::text('fitness_goal',!empty($trainee->traineeDetail)?$trainee->traineeDetail->fitness_goal:null,array('class'=>'form-control','placeholder'=>__('Enter fitness goal')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('category',__('Category'),array('class'=>'form-label')) }}
            {!! Form::select('category', $category, !empty($trainee->traineeDetail)?$trainee->traineeDetail->category:null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('membership_plan',__('Membership'),array('class'=>'form-label')) }}
            {!! Form::select('membership_plan', $membership, !empty($trainee->traineeDetail)?$trainee->traineeDetail->membership_plan:null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('membership_start_date',__('Membership Start Date'),array('class'=>'form-label')) }}
            {{Form::date('membership_start_date',!empty($trainee->traineeDetail)?$trainee->traineeDetail->membership_start_date:null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('trainer_assign',__('Trainer Assign'),array('class'=>'form-label')) }}
            {!! Form::select('trainer_assign', $trainer, !empty($trainee->traineeDetail)?$trainee->traineeDetail->trainer_assign:null,array('class' => 'form-control hidesearch')) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

