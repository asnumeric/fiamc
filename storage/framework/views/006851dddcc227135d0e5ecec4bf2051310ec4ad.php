<?php echo e(Form::open(array('url'=>'workouts','method'=>'post'))); ?>

<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            <label class="form-label me-2"><?php echo e(__('Assign To')); ?> : </label>
            <div class="form-check custom-chek form-check-inline ">
                <input class="form-check-input assign_to" type="radio" value="trainee" id="trainee" name="assign_to" checked>
                <label class="form-check-label" for="trainee"><?php echo e(__('Trainee')); ?> </label>
            </div>
            <div class="form-check custom-chek form-check-inline ">
                <input class="form-check-input assign_to" type="radio" value="class" id="class" name="assign_to">
                <label class="form-check-label" for="class"><?php echo e(__('Class')); ?> </label>
            </div>
        </div>
        <div class="form-group col-md-12 assign trainee">
            <?php echo e(Form::label('trainee',__('Trainee'),array('class'=>'form-label '))); ?>

            <?php echo Form::select('trainee', $trainee, null,array('class' => 'form-control hidesearch basic-select')); ?>

        </div>
        <div class="form-group col-md-12 d-none assign class">
            <?php echo e(Form::label('class',__('Class'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('class', $classes, null,array('class' => 'form-control hidesearch basic-select')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date',__('Start Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('start_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date',__('End Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('end_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>1,'placeholder'=>__('Enter notes')))); ?>

        </div>
    </div>

        <div class="row">
            <div class="col-sm-12">
                <a href="#" class="btn btn-primary btn-xs schedule_clone float-end"><i class="ti ti-plus"></i></a>
            </div>
        </div>
        <div class="row schedule">
            <div class="form-group col-md-3 col-lg-3">
                <?php echo e(Form::label('days',__('Days'),array('class'=>'form-label'))); ?>

                <?php echo Form::select('days[]', $days, null,array('class' => 'form-control')); ?>

            </div>
            <div class="form-group col-md-3 col-lg-3">
                <?php echo e(Form::label('activity',__('Activity'),array('class'=>'form-label'))); ?>

                <?php echo Form::select('activity[]', $activity, null,array('class' => 'form-control')); ?>

            </div>
            <div class="form-group col">
                <?php echo e(Form::label('weight',__('Weight (Kg)'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::number('weight[]',null,array('class'=>'form-control','required'=>'required'))); ?>

            </div>
            <div class="form-group col">
                <?php echo e(Form::label('sets',__('Sets'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::number('sets[]',null,array('class'=>'form-control','required'=>'required'))); ?>

            </div>
            <div class="form-group col">
                <?php echo e(Form::label('reps',__('Reps'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::number('reps[]',null,array('class'=>'form-control','required'=>'required'))); ?>

            </div>
            <div class="form-group col">
                <?php echo e(Form::label('rest',__('Rest (min)'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::number('rest[]',null,array('class'=>'form-control','required'=>'required'))); ?>

            </div>
            <div class="col-auto">
                <a href="#" class="fs-20 text-danger schedule_remove btn-sm "> <i class="ti ti-trash"></i></a>
            </div>
        </div>
        <div class="schedule_results"></div>

</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<script>
    $('.assign_to').on('click', function () {
       var assign=$(this).val();
        $('.assign').addClass('d-none');
       $('.'+assign+'').removeClass('d-none');

    });
    $('.wrapper').on('click', '.schedule_remove', function () {
        $('.schedule_remove').closest('.wrapper').find('.schedule').not(':first').last().remove();
    });
    $('.wrapper').on('click', '.schedule_clone', function () {
        $('.schedule_clone').closest('.wrapper').find('.schedule').first().clone().find("input").val("").end().show().appendTo(".schedule_results:last");


    });
</script>
<?php /**PATH /home/stebio/Workstation/www/Clients/fiamc.asnumeric.com/resources/views/workout/create.blade.php ENDPATH**/ ?>