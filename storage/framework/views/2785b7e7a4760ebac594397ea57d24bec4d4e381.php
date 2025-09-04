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
                                    <th><?php echo app('translator')->get('From'); ?></th>
                                    <th><?php echo app('translator')->get('To'); ?></th>
                                    <th><?php echo app('translator')->get('Fee'); ?></th>  
                                    <th><?php echo app('translator')->get('Cap'); ?></th>  
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $allfees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->index + $allfees->firstItem()); ?></td>
                                        <td><?php echo e(number_format($data->from,2)); ?></td>
                                        <td><?php echo e(number_format($data->to,2)); ?></td>
                                        <td><?php echo e(@$data->fee); ?></td>
                                         <td><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->cap,2)); ?></td>
                                         

                                        <td>
                                            <div class="button--group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo e($data->id); ?>">
                                                        <i class="la la-pencil"></i><?php echo app('translator')->get('Manage'); ?>
                                                    </button> 
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Create Update Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo e($data->id); ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>

                                                <form action="<?php echo e(route('admin.terminal.feeUpdate',$data->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-body">


                                                        <div class="form-group mb-3">
                                                            <label><?php echo app('translator')->get('From'); ?></label>
                                                            <input type="number" value="<?php echo e($data->from); ?>" class="form-control" name="from" required>
                                                        </div> 

                                                        <div class="form-group mb-3">
                                                            <label><?php echo app('translator')->get('To'); ?></label>
                                                            <input type="number" value="<?php echo e($data->to); ?>"  class="form-control" name="to" required>
                                                        </div> 

                                                        <div class="form-group mb-3">
                                                            <label><?php echo app('translator')->get('Fee'); ?> <b>(%)</b></label>
                                                            <input type="number" value="<?php echo e($data->fee); ?>"  class="form-control" name="fee" required>
                                                        </div> 

                                                        <div class="form-group mb-3">
                                                            <label><?php echo app('translator')->get('Cap'); ?> <b>(<?php echo e($general->cur_sym); ?>)</b></label>
                                                            <input type="number"  value="<?php echo e($data->cap); ?>" class="form-control" name="cap" required>
                                                        </div> 


                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Create'); ?></button>
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
                <?php if($allfees->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($allfees)); ?>


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
                            <label><?php echo app('translator')->get('From'); ?></label>
                            <input type="number" class="form-control" name="from" required>
                        </div> 
 
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('To'); ?></label>
                            <input type="number" class="form-control" name="to" required>
                        </div> 
 
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Fee'); ?> <b>(%)</b></label>
                            <input type="number" class="form-control" name="fee" required>
                        </div> 
 
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Cap'); ?> <b>(<?php echo e($general->cur_sym); ?>)</b></label>
                            <input type="number" class="form-control" name="cap" required>
                        </div> 
 

                    </div>
                         <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Create'); ?></button>
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
    <button type="button" class="btn btn-sm btn-outline-primary cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New Fee'); ?>">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New Fee'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
     
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/terminals/fee.blade.php ENDPATH**/ ?>