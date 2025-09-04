<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('SL'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Currency'); ?></th>
                                    <th><?php echo app('translator')->get('Rate'); ?></th>
                                    <th><?php echo app('translator')->get('Fee'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($accounts->firstItem() + $loop->index); ?></td>
                                        <td><?php echo e(__($data->name)); ?></td>
                                        <td><?php echo e(__($data->currency)); ?></td>
                                        <td>1 <?php echo e(__($data->currency)); ?> = <?php echo e(number_format($data->rate,2)); ?> <?php echo e($general->cur_text); ?></td>
                                        <td><?php echo e(__($data->fee)); ?>%</td>
                                        <td>
                                            <?php
                                                echo $data->statusBadge;
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary cuModalBtn" data-resource="<?php echo e($data); ?>" data-modal_title="<?php echo app('translator')->get('Update Category'); ?>">
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                            
                                            <?php if($data->status == Status::DISABLE): ?>
                                                <button type="button" class="btn btn-sm btn-success confirmationBtn" data-action="<?php echo e(route('admin.paymentaccount.status', $data->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this account?'); ?>">
                                                    <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-sm btn-danger confirmationBtn" data-action="<?php echo e(route('admin.paymentaccount.delete', $data->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to delete this account?'); ?>">
                                                    <i class="la la-eye-slash"></i><?php echo app('translator')->get('Delete'); ?>
                                                </button>
                                             
                                                <button type="button" class="btn btn-sm btn-warning confirmationBtn" data-action="<?php echo e(route('admin.paymentaccount.status', $data->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this account?'); ?>">
                                                    <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                </button>
                                            <?php endif; ?> 
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
                <?php if($accounts->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($accounts)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Create Update Modal -->
    <div class="modal fade" id="cuModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.paymentaccount.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mb-4">
                            <label><?php echo app('translator')->get('Currency'); ?></label>
                            <input type="text" class="form-control" name="currency">
                        </div>

                        <div class="form-group mb-4">
                            <label><?php echo app('translator')->get('Account Details'); ?></label>
                            <input type="text" class="form-control" name="details">
                        </div>
                        <div class="form-group mb-4">
                            <label><?php echo app('translator')->get('Exchange Rate'); ?></label>
                            <input type="text" class="form-control" name="rate">
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Fee'); ?></label>
                            <input type="text" class="form-control" name="fee">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
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

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <button type="button" class="btn btn-sm btn-primary me-2 h-45 cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New'); ?>">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/paymentaccount/index.blade.php ENDPATH**/ ?>