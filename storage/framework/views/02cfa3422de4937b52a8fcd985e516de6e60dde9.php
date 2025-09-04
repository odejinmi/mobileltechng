<?php $__env->startSection('panel'); ?>
<section class="section-b-space">
    <div class="custom-container"> 
  
      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = @$deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail<?php echo e($deposit->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <i class="icon" data-feather="printer"></i>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e(__($deposit->trx)); ?></h5>
                  <h3 class="<?php if($deposit->status == Status::PAYMENT_SUCCESS): ?> success-color <?php else: ?> error-color <?php endif; ?>"> <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->payment)); ?><span></span></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"><?php echo e(__($deposit->gateway?->name)); ?></h5>
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
          <h2 class="modal-title">Deposit Detail</h2>
        </div>
        <div class="modal-body">
          <ul class="details-list">
            <li>
              <h3 class="fw-normal dark-text">Status</h3>
              <h3 class="fw-normal light-text"> <?php echo $deposit->statusBadge ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Date</h3>
              <h3 class="fw-normal light-text"><?php echo e(showDateTime($deposit->created_at)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Time</h3>
              <h3 class="fw-normal light-text"><?php echo e(diffForHumans($deposit->created_at)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Amount </h3>
              <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->amount)); ?></h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Fee</h3>
              <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->charge)); ?></h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Rate</h3>
              <h3 class="fw-normal light-text">
                1 <?php echo e(__($general->cur_text)); ?> = <?php echo e(showAmount($deposit->rate)); ?> <?php echo e(__($deposit->method_currency)); ?>

              </h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Final Amount</h3>
              <h3 class="fw-normal light-text"><?php echo e(showAmount($deposit->final_amo)); ?>

                <?php echo e(__($deposit->method_currency)); ?></h3>
            </li>  
             
          </ul>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
            <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- successful transfer modal end -->
  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php echo emptyData2(); ?>

        <?php endif; ?>
      </div>
      <?php if($deposits->hasPages()): ?>
      <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            <?php echo e($deposits->links()); ?>

        </ul>
    </nav> 
      <?php endif; ?>
       
    </div>
  </section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.deposit.index')); ?>" class="back-btn">
    <i class="icon" data-feather="grid"></i>
  </a>
<?php $__env->stopPush(); ?> 
<?php $__env->startPush('script'); ?> 
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong><?php echo app('translator')->get('Admin Feedback'); ?></strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }
                modal.find('.feedback').html(adminFeedback);
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/deposit_history.blade.php ENDPATH**/ ?>