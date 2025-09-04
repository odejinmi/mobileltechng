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
              <img src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e($deposit->asset->image); ?>" width="30" class="path1"/>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e(__($deposit->deposit_code)); ?></h5>
                <h3 class="<?php if($deposit->status == 'success'): ?> success-color <?php else: ?> error-color <?php endif; ?>"> $<?php echo e(showAmount($deposit->payment)); ?><span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->value)); ?></h5>
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
        <h2 class="modal-title">Trade Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text"><label class='badge text-white  <?php if($deposit->status == 'success'): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>'> <?php echo $deposit->status ?></label></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text">1<?php echo e(showDateTime($deposit->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text"><?php echo e(diffForHumans($deposit->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Asset </h3>
            <h3 class="fw-normal light-text"><?php echo e(__($deposit->product_name)); ?></h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Symbol</h3>
            <h3 class="fw-normal light-text"><?php echo e(__($deposit->asset->symbol)); ?></h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Rate</h3>
            <h3 class="fw-semibold <?php if($deposit->status == 'success'): ?> success-color <?php else: ?> error-color <?php endif; ?>"><?php echo e(showAmount($deposit->price)); ?> <?php echo e(__($general->cur_text)); ?></h3>
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
    <br>
    <nav aria-label="Page navigation example mt-4">
      <ul class="pagination justify-content-center">
          <?php echo e($log->links()); ?>

      </ul>
  </nav> 
    <?php endif; ?>
     
  </div>
</section>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.crypto.sell')); ?>" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?>
  
<?php $__env->stopSection(); ?>
 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/assets/crypto/sellcrypto/sell_log.blade.php ENDPATH**/ ?>