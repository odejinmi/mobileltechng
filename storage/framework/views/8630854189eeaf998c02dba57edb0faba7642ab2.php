<?php $__env->startSection('panel'); ?>

    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">

                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Method'); ?></th>
                                <th><?php echo app('translator')->get('Currency'); ?></th>
                                <th><?php echo app('translator')->get('Charge'); ?></th>
                                <th><?php echo app('translator')->get('Withdraw Limit'); ?></th>
                                <th><?php echo app('translator')->get('Processing Time'); ?> </th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('Method'); ?>">
                                        <div class="user">
                                            <div class="thumb"><img width="50" src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'].'/'. $method->image,imagePath()['withdraw']['method']['size'])); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>

                                            <span class="name"><?php echo e(__($method->name)); ?></span>
                                        </div>
                                    </td>

                                    <td data-label="<?php echo app('translator')->get('Currency'); ?>"
                                        class="font-weight-bold"><?php echo e(__($method->currency)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Charge'); ?>"
                                        class="font-weight-bold"><?php echo e(showAmount($method->fixed_charge)); ?> <?php echo e(__($general->cur_text)); ?> <?php echo e((0 < $method->percent_charge) ? ' + '. showAmount($method->percent_charge) .' %' : ''); ?> </td>
                                    <td data-label="<?php echo app('translator')->get('Withdraw Limit'); ?>"
                                        class="font-weight-bold"><?php echo e($method->min_limit + 0); ?>

                                        - <?php echo e($method->max_limit + 0); ?> <?php echo e(__($general->cur_text)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Processing Time'); ?>"><?php echo e($method->delay); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                        <?php if($method->status == 1): ?>
                                            <span class="text--small badge font-weight-normal bg-success"><?php echo app('translator')->get('Active'); ?></span>
                                        <?php else: ?>
                                            <span class="text--small badge font-weight-normal bg-warning"><?php echo app('translator')->get('Disabled'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <a href="<?php echo e(route('admin.withdraw.method.edit', $method->id)); ?>"
                                           class="btn btn-outline-primary ml-1" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Edit'); ?>"><i class="ti ti-edit"></i></a>
                                        <?php if($method->status == 1): ?>
                                            <a href="javascript:void(0)" class="btn btn-outline-danger deactivateBtn  ml-1" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Disable'); ?>" data-id="<?php echo e($method->id); ?>" data-name="<?php echo e(__($method->name)); ?>">
                                                <i class="ti ti-x"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="btn btn-outline-success activateBtn  ml-1"
                                               data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Enable'); ?>"
                                               data-id="<?php echo e($method->id); ?>" data-name="<?php echo e(__($method->name)); ?>">
                                                <i class="ti ti-check"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo alert('danger',$emptyMessage); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>


    
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Withdrawal Method Activation Confirmation'); ?></h5>
                    
                </div>
                <form action="<?php echo e(route('admin.withdraw.method.activate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to activate'); ?> <span class="font-weight-bold method-name"></span> <?php echo app('translator')->get('method'); ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-outline-primary"><?php echo app('translator')->get('Activate'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Withdrawal Method Disable Confirmation'); ?></h5>
                     
                </div>
                <form action="<?php echo e(route('admin.withdraw.method.deactivate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to disable'); ?> <span class="font-weight-bold method-name"></span> <?php echo app('translator')->get('method'); ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-outline-danger"><?php echo app('translator')->get('Disable'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a class="btn btn-sm btn-outline-primary box--shadow1 text--small" href="<?php echo e(route('admin.withdraw.method.create')); ?>"><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $('.activateBtn').on('click', function () {
                var modal = $('#activateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.deactivateBtn').on('click', function () {
                var modal = $('#deactivateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/withdraw/index.blade.php ENDPATH**/ ?>