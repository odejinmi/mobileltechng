<?php $__env->startSection('panel'); ?>
    <div class="card b-radius--10">
        <div class="card-body p-0">
            <div class="table-responsive--md table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('S.N.'); ?></th>
                            <th><?php echo app('translator')->get('Plan'); ?></th>
                            <th><?php echo app('translator')->get('Users Profit'); ?></th>
                            <th><?php echo app('translator')->get('Deposit Amount'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                            <?php if(can('admin.plans.fdr.save') || can('admin.plans.fdr.status')): ?>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->index + $plans->firstItem()); ?></td>

                                <td>
                                    <span class="fw-bold text-primary"><?php echo e(__($plan->name)); ?></span>
                                    <br>
                                    <span class="fw-bold"><?php echo e($plan->locked_days); ?></span> <?php echo app('translator')->get('Days Lock-in Period'); ?>
                                </td>

                                <td>
                                    <span class="text--primary fw-bold"><?php echo e(getAmount($plan->interest_rate)); ?>%</span>
                                    <?php echo app('translator')->get('of Total Amount'); ?>
                                    <br>
                                    <?php echo app('translator')->get('For Every'); ?> <span class="text--primary"><?php echo e(__($plan->installment_interval)); ?></span> <?php echo app('translator')->get('Days'); ?>
                                </td>

                                <td>
                                    <?php echo app('translator')->get('Min'); ?>: <span class="fw-bold"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->minimum_amount)); ?></span>
                                    <br>
                                    <?php echo app('translator')->get('Max'); ?>: <span class="fw-bold"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->maximum_amount)); ?></span>
                                </td>

                                <td> <?php echo $plan->statusBadge; ?> </td>

                                <?php if(can('admin.plans.fdr.save') || can('admin.plans.fdr.status')): ?>
                                    <td>
                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.plans.fdr.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary cuModalBtn" data-resource="<?php echo e($plan); ?>" data-modal_title="<?php echo app('translator')->get('Edit Plan'); ?>" data-has_status="1"><i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                        <?php endif ?>

                                        <?php $hasPermission = App\Models\Role::hasPermission('admin.plans.fdr.status')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <?php if($plan->status): ?>
                                                <button type="button" data-action="<?php echo e(route('admin.plans.fdr.status', $plan->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this plan?'); ?>" class="btn btn-sm confirmationBtn btn-outline-danger">
                                                    <i class="la la-la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                </button>
                                            <?php else: ?>
                                                <button type="button" data-action="<?php echo e(route('admin.plans.fdr.status', $plan->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this plan?'); ?>" class="btn btn-sm confirmationBtn btn-outline-success">
                                                    <i class="la la-la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                </button>
                                            <?php endif; ?>
                                        <?php endif ?>
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
    <?php $hasPermission = App\Models\Role::hasPermission('admin.plans.fdr.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <?php echo $__env->make('admin.plans.fdr.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif ?>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.plans.fdr.save')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <!-- Modal Trigger Button -->
        <button type="button" class="btn btn-sm btn-outline-primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add Plan'); ?>">
            <i class="las la-plus"></i><?php echo app('translator')->get('Add Plan'); ?>
        </button>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            let modal = $("#cuModal");

            $('[name=interest_rate], [name=minimum_amount], [name=maximum_amount]').on('input', () => calculateProfit());

            function calculateProfit() {
                let minAmount = Number($('[name=minimum_amount]').val());
                let maxAmount = Number($('[name=maximum_amount]').val());
                let interest = Number($('[name=interest_rate]').val()) / 100;
                let interval = $('[name=installment_interval]').val();
                let totalMinAmount = minAmount * interest;
                let totalMaxAmount = maxAmount * interest;

                if (minAmount && maxAmount && interest) {
                    modal.find('#minAmount').text(`${showAmount(totalMinAmount)} <?php echo app('translator')->get($general->cur_text); ?>`);
                    modal.find('#maxAmount').text(`${showAmount(totalMaxAmount)} <?php echo app('translator')->get($general->cur_text); ?>`);
                    modal.find('#perInterval').text(interval);
                    modal.find('.final-amount').removeClass('d-none');
                }
            }

            $('#cuModal').on('show.bs.modal', function(e) {
                calculateProfit();
            });

            $('#cuModal').on('hidden.bs.modal', function(e) {
                modal.find('.final-amount').addClass('d-none');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/plans/fdr/index.blade.php ENDPATH**/ ?>