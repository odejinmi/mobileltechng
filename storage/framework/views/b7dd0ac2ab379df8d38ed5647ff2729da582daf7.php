 <!-- Modal -->
 <div class="modal fade" id="cuModal">
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
             <form action="<?php echo e(route('admin.plans.fdr.save')); ?>" method="POST" id="abc">
                 <?php echo csrf_field(); ?>
                 <div class="modal-header">
                     <h5 class="modal-title"></h5>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <i class="las la-times"></i>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">

                         <div class="form-group col-lg-6 mb-3">
                             <label><?php echo app('translator')->get('Name'); ?></label>
                             <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                         </div>

                         <div class="form-group col-lg-6 mb-3">
                             <label><?php echo app('translator')->get('Interest Rate'); ?></label>
                             <div class="input-group">
                                 <input type="number" step="any" name="interest_rate" value="<?php echo e(old('interest_rate')); ?>" class="form-control">
                                 <span class="input-group-text"><?php echo app('translator')->get('%'); ?></span>
                             </div>
                         </div>

                         <div class="form-group col-lg-6 mb-3">
                             <label><?php echo app('translator')->get('Installment Interval'); ?></label>
                             <div class="input-group">
                                 <input type="number" name="installment_interval" value="<?php echo e(old('installment_interval')); ?>" class="form-control">
                                 <span class="input-group-text"><?php echo app('translator')->get('Days'); ?></span>
                             </div>
                         </div>

                         <div class="form-group col-lg-6 mb-3">
                             <label><?php echo app('translator')->get('Locked Days'); ?></label>
                             <div class="input-group">
                                 <input type="number" name="locked_days" value="<?php echo e(old('locked_days')); ?>" class="form-control">
                                 <span class="input-group-text"><?php echo app('translator')->get('Days'); ?></span>
                             </div>
                         </div>

                         <div class="form-group col-lg-6 mb-3">
                             <label><?php echo app('translator')->get('Minimum Amount'); ?></label>
                             <div class="input-group">
                                 <input type="number" step="any" class="form-control" name="minimum_amount" value="<?php echo e(old('minimum_amount')); ?>" required />
                                 <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                             </div>
                         </div>

                         <div class="form-group col-lg-6 mb-3">
                             <label><?php echo app('translator')->get('Maximum Amount'); ?></label>
                             <div class="input-group">
                                 <input type="number" step="any" class="form-control" name="maximum_amount" value="<?php echo e(old('maximum_amount')); ?>" required />
                                 <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                             </div>
                         </div>
                     </div>

                     <div class="final-amount text-center d-none">
                         <h6>
                             <i class="fa fa-info-circle text--primary"></i>
                             <?php echo app('translator')->get('User will get a minimum amount of'); ?>
                             <span class="text--primary fw-bold" id="minAmount"></span>
                             <?php echo app('translator')->get('to a maximum amount of'); ?>
                             <span class="text--primary fw-bold" id="maxAmount"></span>
                             <?php echo app('translator')->get('per'); ?> <span class="text--primary fw-bold" id="perInterval"></span> <?php echo app('translator')->get('days'); ?>
                         </h6>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                 </div>
             </form>
         </div>
     </div>
 </div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/plans/fdr/form.blade.php ENDPATH**/ ?>