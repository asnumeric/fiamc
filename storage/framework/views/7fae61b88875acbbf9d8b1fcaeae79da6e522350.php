<?php
    $profile=asset(Storage::url('upload/profile/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Trainees')); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Trainees')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('manage trainee')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('trainees.create')); ?>"
           data-title="<?php echo e(__('Create Trainee')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Trainee')); ?>

        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th><?php echo e(__('ID')); ?></th>
                            <th><?php echo e(__('User')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Phone Number')); ?></th>
                            <th><?php echo e(__('Category')); ?></th>
                            <th><?php echo e(__('Membership')); ?></th>
                            <th><?php echo e(__('Expiry Date')); ?></th>
                            <?php if(Gate::check('edit trainee') ||  Gate::check('delete trainee') ||  Gate::check('show trainee')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $trainees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e(traineePrefix().$trainee->traineeDetail->trainee_id); ?> </td>
                                <td class="table-user">
                                    <img
                                        src="<?php echo e(!empty($trainee->avatar)?asset(Storage::url('upload/profile')).'/'.$trainee->avatar:asset(Storage::url('upload/profile')).'/avatar.png'); ?>"
                                        alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                    <a href="#" class="text-body font-weight-semibold"><?php echo e($trainee->name); ?></a>
                                </td>
                                <td><?php echo e($trainee->email); ?> </td>
                                <td><?php echo e(!empty($trainee->phone_number)?$trainee->phone_number:'-'); ?> </td>
                                <td><?php echo e(!empty($trainee->traineeDetail)?!empty($trainee->traineeDetail->categorys)?$trainee->traineeDetail->categorys->title:'-':'-'); ?> </td>
                                <td><?php echo e(!empty($trainee->traineeDetail)?!empty($trainee->traineeDetail->membership)?$trainee->traineeDetail->membership->title:'-':'-'); ?> </td>
                                <td><?php echo e(!empty($trainee->traineeDetail)?!empty($trainee->traineeDetail->membership_expiry_date)?dateFormat($trainee->traineeDetail->membership_expiry_date):__('Lifetime'):'-'); ?> </td>
                                <?php if(Gate::check('edit trainee') ||  Gate::check('delete trainee') ||  Gate::check('show trainee')): ?>
                                    <td>
                                        <div class="cart-action">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['trainees.destroy', $trainee->id]]); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show trainee')): ?>
                                                <a class="text-warning " data-bs-toggle="tooltip"
                                                   data-size="lg" data-bs-original-title="<?php echo e(__('Details')); ?>"
                                                   href="<?php echo e(route('trainees.show',\Illuminate\Support\Facades\Crypt::encrypt($trainee->id))); ?>"
                                                > <i data-feather="eye"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit trainee')): ?>
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-size="lg"
                                                   data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                   data-url="<?php echo e(route('trainees.edit',$trainee->id)); ?>"
                                                   data-title="<?php echo e(__('Edit Trainee')); ?>"> <i data-feather="edit"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete trainee')): ?>
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                        data-feather="trash-2"></i></a>
                                            <?php endif; ?>
                                            <?php echo Form::close(); ?>

                                        </div>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/stebio/Workstation/www/Clients/fiamc.asnumeric.com/resources/views/trainee/index.blade.php ENDPATH**/ ?>