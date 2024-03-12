<?php $__env->startSection('page-title'); ?>
    <?php echo e($classes->title); ?> <?php echo e(__('Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('classes.index')); ?>"><?php echo e(__('Classes')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e($classes->title); ?> <?php echo e(__('Details')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Class Details')); ?></h4>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit class')): ?>
                        <div class="setting-card action-menu">
                            <a class="text-success customModal" data-bs-toggle="tooltip"
                               data-size="lg" data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                               data-url="<?php echo e(route('classes.edit',$classes->id)); ?>"
                               data-title="<?php echo e(__('Edit Class')); ?>"> <i data-feather="edit"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6><?php echo e(__('Title')); ?></h6>
                                <p class="mb-20"><?php echo e($classes->title); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6><?php echo e(__('Fees')); ?></h6>
                                <p class="mb-20"><?php echo e(priceFormat($classes->fees)); ?> </p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6><?php echo e(__('Address')); ?></h6>
                                <p class="mb-20"> <?php echo e($classes->address); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="detail-group">
                                <h6><?php echo e(__('Notes')); ?></h6>
                                <p class="mb-20"> <?php echo e($classes->notes); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Schedule')); ?></h4>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit class')): ?>
                        <div class="setting-card action-menu">
                            <a class="text-success customModal" data-bs-toggle="tooltip"
                               data-size="lg" data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                               data-url="<?php echo e(route('classes.edit',$classes->id)); ?>"
                               data-title="<?php echo e(__('Edit Class')); ?>"> <i data-feather="edit"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Day')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $classes->classSchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($schedule->days); ?> </td>
                                    <td><?php echo e(timeFormat($schedule->start_date)); ?> </td>
                                    <td><?php echo e(timeFormat($schedule->end_date)); ?> </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-6 cdx-xxl-50">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Trainee')); ?></h4>
                    <?php if(Gate::check('user assign class')): ?>
                        <div class="setting-card action-menu">
                            <div class="setting-card action-menu">
                                <a class="text-primary customModal" data-bs-toggle="tooltip"
                                   data-size="lg" data-bs-original-title="<?php echo e(__('Assign Trainee')); ?>" href="#"
                                   data-url="<?php echo e(route('classes.user.assign',[$classes->id,'trainee'])); ?>"
                                   data-title="<?php echo e(__('Assign Trainee')); ?>"> <i data-feather="user-plus"></i></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Phone Number')); ?></th>
                                <?php if( Gate::check('user delete class')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $classes->classAssignTrainee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(traineePrefix().!empty($trainee->userDetail)?!empty($trainee->userDetail->traineeDetail)?$trainee->userDetail->traineeDetail->trainee_id:'-':'-'); ?> </td>
                                    <td class="table-user">
                                        <img
                                            src="<?php echo e(isset($trainee->userDetail->avatar)&&!empty($trainee->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'); ?>"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#"
                                           class="text-body font-weight-semibold"><?php echo e(!empty($trainee->userDetail)?$trainee->userDetail->name:'-'); ?></a>
                                    </td>
                                    <td><?php echo e(isset($trainee->userDetail->phone_number) && !empty($trainee->userDetail->phone_number)?$trainee->userDetail->phone_number:'-'); ?> </td>
                                    <?php if(Gate::check('user delete class')): ?>
                                        <td>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['classes.user.remove', $trainee->id]]); ?>


                                            <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                               data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                    data-feather="trash-2"></i></a>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 cdx-xxl-50">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Trainer')); ?></h4>
                    <?php if(Gate::check('user assign class')): ?>
                        <div class="setting-card action-menu">
                            <div class="setting-card action-menu">
                                <a class="text-primary customModal" data-bs-toggle="tooltip"
                                   data-size="lg" data-bs-original-title="<?php echo e(__('Assign Trainer')); ?>" href="#"
                                   data-url="<?php echo e(route('classes.user.assign',[$classes->id,'trainer'])); ?>"
                                   data-title="<?php echo e(__('Assign Trainer')); ?>"> <i data-feather="user-plus"></i></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Phone Number')); ?></th>
                                <?php if( Gate::check('user delete class')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $classes->classAssignTrainer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(trainerPrefix().$trainer->userDetail->trainerDetail->trainee_id); ?> </td>
                                    <td class="table-user">
                                        <img
                                            src="<?php echo e(!empty($trainer->userDetail->avatar)?asset(Storage::url('upload/profile')).'/'.$trainer->userDetail->avatar:asset(Storage::url('upload/profile')).'/avatar.png'); ?>"
                                            alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                        <a href="#"
                                           class="text-body font-weight-semibold"><?php echo e($trainer->userDetail->name); ?></a>
                                    </td>
                                    <td><?php echo e(!empty($trainer->userDetail->phone_number)?$trainer->userDetail->phone_number:'-'); ?> </td>
                                    <?php if( Gate::check('user delete class')): ?>
                                        <td>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['classes.user.remove', $trainer->id]]); ?>

                                            <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                               data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                    data-feather="trash-2"></i></a>
                                            <?php echo Form::close(); ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/stebio/Workstation/www/Clients/fiamc.asnumeric.com/resources/views/classes/show.blade.php ENDPATH**/ ?>