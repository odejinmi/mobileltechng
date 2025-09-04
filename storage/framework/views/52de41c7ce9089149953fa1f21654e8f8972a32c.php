<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Created At'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($role->name); ?></td>
                                        <td><?php echo e(showDateTime($role->created_at)); ?></td>
                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission('admin.roles.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <a href="<?php echo e(route('admin.roles.edit', $role->id)); ?>" class="btn btn-sm btn-outline-primary"><i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.roles.add')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a href="<?php echo e(route('admin.roles.add')); ?>" class="btn btn-outline-primary"><i class="la la-plus"></i> <?php echo app('translator')->get('Add New'); ?></a>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/roles/index.blade.php ENDPATH**/ ?>