
{{ Form::model($workoutActivity, array('route' => array('activity.update', $workoutActivity->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('title',__('Title'),array('class'=>'form-label')) }}
            {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter title'),'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}


