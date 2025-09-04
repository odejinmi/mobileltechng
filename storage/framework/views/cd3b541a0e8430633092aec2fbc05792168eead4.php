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
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e(__($deposit->product_name)); ?></h5>
                <h3 class=" <?php if($deposit->status == 'success'): ?> success-color <?php else: ?> error-color <?php endif; ?>"> <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->payment)); ?><span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text"><?php echo e(__($deposit->product_logo)); ?></h5>
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
        <h2 class="modal-title">Funding Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text"><label class='badge <?php if($deposit->status == 'delivered'): ?> bg-success  <?php else: ?>  bg-danger <?php endif; ?>'><?php echo $deposit->status ?></label></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text"><?php echo e(showDateTime($deposit->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text"><?php echo e(diffForHumans($deposit->created_at)); ?></h3>
          </li>
          <?php if($deposit->deposit_code == 'motor'): ?>
          <li>
            <h3 class="fw-normal dark-text">Download </h3>
            <h3 class="fw-normal light-text"> <a href="<?php echo e(__($deposit->val_2)); ?>">
              <div class="categories-box">
              <i class="categories-icon" data-feather="download"></i>
            </div></a></h3>
          </li> 
          <?php endif; ?>
          <li>
            <h3 class="fw-normal dark-text">Number</h3>
            <h3 class="fw-normal light-text"><?php echo $deposit->val_3; ?></h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-semibold error-color"><?php echo e(__($general->cur_text)); ?> <?php echo e(showAmount($deposit->payment)); ?></h3>
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
    <?php if($log->hasPages()): ?>
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          <?php echo e($log->links()); ?>

      </ul>
  </nav> 
    <?php endif; ?>
     
  </div>
</section>
<?php $__env->stopSection(); ?>
<!-- person transaction list section end -->
  
<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.buy.insurance')); ?>" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/bills/insurance/insurance_log.blade.php ENDPATH**/ ?>