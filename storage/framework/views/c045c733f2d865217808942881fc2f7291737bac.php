<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Terminal ID'); ?></th>
                                    <th><?php echo app('translator')->get('Serial Number'); ?></th>
                                    <th><?php echo app('translator')->get('Customer'); ?></th>  
                                    <th><?php echo app('translator')->get('Status'); ?></th>  
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $allTerminals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->index + $allTerminals->firstItem()); ?></td>
                                        <td><?php echo e($data->terminal_id); ?></td>
                                        <td><?php echo e(__($data->terminal_sn)); ?></td>
                                        <td><?php echo e(@$data->user->username ?? 'N/A'); ?><br>
                                        <small><?php echo e(@$data->user->email); ?></small>
                                        </td> 

                                        <td>
                                            <?php
                                                echo $data->statusBadge;
                                            ?>
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo e($data->id); ?>">
                                                        <i class="la la-pencil"></i><?php echo app('translator')->get('Manage'); ?>
                                                    </button> 
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Create Update Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>

                                                <form action="<?php echo e(route('admin.terminal.unmap', $data->terminal_id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-body"> 

                                                        <div class="form-group mb-3">
                                                            <label><?php echo app('translator')->get('Customer'); ?></label>
                                                            <select name="user" class="form-control" required>
                                                                <option value="" disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                                                                <option value="0">UNMAP TERMINAL</option>
                                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option <?php if($user->id == $data->user_id): ?> selected <?php endif; ?> value="<?php echo e($user->id); ?>"><?php echo e($user->username); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div> 

                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($allTerminals->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($allTerminals)); ?>


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

                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
 

                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Serial Number'); ?></label>
                            <input type="text" class="form-control" name="serialnumber" required>
                        </div> 

                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Customer'); ?></label>
                            <select name="user" class="form-control" required>
                                <option value="" disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->username); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div> 

                    </div>
                         <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                 </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Serial Number']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Serial Number']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <button type="button" class="btn btn-sm btn-outline-primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Terminal'); ?>">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New TYerminal'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
     
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/terminals/index.blade.php ENDPATH**/ ?>