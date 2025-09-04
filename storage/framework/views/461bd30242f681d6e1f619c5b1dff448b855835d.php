<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card  b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Plan'); ?></th>
                                    <th><?php echo app('translator')->get('Limit'); ?></th>
                                    <th><?php echo app('translator')->get('Installment'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(__($loop->index + $plans->firstItem())); ?></td>

                                        <td>
                                            <span class="fw-bold text--primary"><?php echo e(__($plan->name)); ?></span>
                                            <br>
                                            <?php echo app('translator')->get('For'); ?>
                                            <span class="fw-bold">
                                                <?php echo e($plan->total_installment * $plan->installment_interval); ?>

                                            </span>
                                            <?php echo app('translator')->get('days'); ?>
                                        </td>

                                        <td>
                                            <span class="fw-bold"><?php echo app('translator')->get('Min'); ?>:</span> <?php echo e($general->cur_sym . showAmount($plan->minimum_amount)); ?>

                                            <br>
                                            <span class="fw-bold"><?php echo app('translator')->get('Max'); ?>:</span> <?php echo e($general->cur_sym . showAmount($plan->maximum_amount)); ?>

                                        </td>

                                        <td>
                                            <span class="text--primary"><?php echo e($plan->per_installment + 0); ?>%</span>
                                            <?php echo app('translator')->get('every'); ?>
                                            <span class="text--primary"><?php echo e($plan->installment_interval); ?></span> <?php echo app('translator')->get('Days'); ?>
                                            <br>
                                            <?php echo app('translator')->get('for'); ?> <span class="text--primary"><?php echo e($plan->total_installment); ?></span>
                                            <?php echo app('translator')->get('Times'); ?>
                                        </td>

                                        <td> <?php echo $plan->statusBadge; ?> </td>

                                            <td>
                                                <div class="button--group">
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.plans.loan.edit')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <a href="<?php echo e(route('admin.plans.loan.edit', $plan->id)); ?>" class="btn btn-sm btn-primary">
                                                            <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                                        </a>
                                                    <?php endif ?>

                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.plans.loan.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <?php if($plan->status): ?>
                                                            <button type="button" data-action="<?php echo e(route('admin.plans.loan.status', $plan->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this plan?'); ?>" class="btn btn-sm confirmationBtn btn-danger">
                                                                <i class="la la-la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" data-action="<?php echo e(route('admin.plans.loan.status', $plan->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this plan?'); ?>" class="btn btn-sm confirmationBtn btn-success">
                                                                <i class="la la-la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                            </button>
                                                        <?php endif; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
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
                <?php if($plans->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($plans)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.plans.loan.create')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a href="<?php echo e(route('admin.plans.loan.create')); ?>" class="btn btn-sm btn-outline--primary">
            <i class="la la-plus"></i> <?php echo app('translator')->get('Add New'); ?>
        </a>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/plans/loan/index.blade.php ENDPATH**/ ?>