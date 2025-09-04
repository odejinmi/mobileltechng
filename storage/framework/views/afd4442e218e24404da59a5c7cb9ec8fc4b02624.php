<?php $__env->startSection('panel'); ?>
 
  <!-- person transaction list section starts -->
  <section class="section-b-space">
    <div class="custom-container">
       
      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail<?php echo e($deposit->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <div class="categories-box">
                  <i class="categories-icon <?php if($deposit->status == 1): ?> text-success <?php elseif($deposit->status == 0): ?> text-info <?php elseif($deposit->status == 2): ?>  text-warning <?php else: ?>  text-danger <?php endif; ?>" data-feather="file-text"></i>
                </div>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e(__(@$deposit->account->name)); ?></h5>
                  <h3 class="<?php if($deposit->status == 1): ?> text-success <?php elseif($deposit->status == 0): ?> text-info <?php elseif($deposit->status == 2): ?>  text-warning <?php else: ?>  text-danger <?php endif; ?>"> <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->amount)); ?></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"><?php echo e(__($deposit->details)); ?></h5>
                  <h5 class="light-text"><?php echo e(diffForHumans($deposit->created_at)); ?></h5>
                </div>
              </div>
            </a>
          </div>
        </div>


                                <!-- transaction detail modal start -->
                                <div class="modal successful-modal transfer-details fade" id="transaction-detail<?php echo e($deposit->id); ?>" tabindex="-1">
                                  <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      <h2 class="modal-title">Transaction Detail</h2>
                                      </div>
                                      <div class="modal-body">
                                      <ul class="details-list">
                                          <li>
                                          <h3 class="fw-normal dark-text">Status</h3>
                                          <h3 class="fw-normal light-text"> <label class='badge <?php if($deposit->status == 1): ?> bg-success <?php elseif($deposit->status == 0): ?>  bg-dark text-white <?php elseif($deposit->status == 2): ?>  bg-warning <?php else: ?>  bg-danger <?php endif; ?>'> <?php if($deposit->status == 1): ?> Successful <?php elseif($deposit->status == 2): ?> Pending Approval <?php elseif($deposit->status == 0): ?> Unpaid <?php elseif($deposit->status == 3): ?> Canceled <?php else: ?> Declined <?php endif; ?></label></h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Date</h3>
                                          <h3 class="fw-normal light-text"><?php echo e(showDateTime($deposit->created_at)); ?></h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Account</h3>
                                          <h3 class="fw-normal light-text"><?php echo e(__(@$deposit->account->name)); ?></h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Beneficiary</h3>
                                          <h3 class="fw-normal light-text"><?php echo e(__($deposit->details)); ?></h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Amount</h3>
                                          <h3 class="fw-normal light-text"><?php echo e(showAmount($deposit->amount)); ?> <?php echo e(__($general->cur_text)); ?></h3>
                                          </li> 
                                          <?php if($deposit->status == 0): ?> 
                                           <a href="<?php echo e(route('user.requestaccount.confirm',encrypt($deposit->trx))); ?>" class="btn theme-btn w-100">Make Payment</a>
                                          <a href="<?php echo e(route('user.requestaccount.cancel',encrypt($deposit->trx))); ?>" class="btn theme-btn w-100 bg-danger">Cancel Request</a>
                                          <?php endif; ?>
                                      </ul>
                                      </div>
                                      <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                                      <i class="icon" data-feather="x"></i>
                                      </button>
                                  </div>
                                  </div>
                              </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php echo emptyData2(); ?>

        <?php endif; ?>
         
      </div>

      
    </div>
  </section>
  <!-- person transaction list section end -->
  
<?php $__env->stopSection(); ?>
  
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/vendor/request_account/history.blade.php ENDPATH**/ ?>