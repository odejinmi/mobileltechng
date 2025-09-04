<?php $__env->startSection('panel'); ?>



<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
      <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail<?php echo e($item->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="categories-icon" data-feather="gift"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e($general->cur_sym); ?><?php echo e(showAmount($item->amount)); ?></h5>
                <h3 class="<?php if($item->status == 1): ?> success-color <?php else: ?> error-color <?php endif; ?>"> <?php if($item->status == 1): ?> Active <?php else: ?> Used <?php endif; ?><span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="text-dark">Amount</h5>
                <h5 class="light-text"><?php echo e(diffForHumans($item->created_at)); ?></h5>
              </div>
            </div>
          </a>
        </div>
      </div>


<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="transaction-detail<?php echo e($item->id); ?>" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Voucher Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text"><?php echo e(showDateTime($item->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text"><?php echo e(diffForHumans($item->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Amount </h3>
            <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($item->amount)); ?></h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Code</h3>
            <h3 class="fw-normal light-text">
              <?php echo e(__($item->code)); ?>

            </h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Beneficiary</h3>
            <h3 class="fw-normal light-text">
              <?php echo e(__(@$item->user->username)); ?>

            </h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text">
              <?php if($item->status == 1): ?>
                                                  <span
                                                      class="badge bg-success">Active</span>
                                              <?php else: ?>
                                                  <span
                                                      class="badge bg-danger">Used</span>
                                             
                                              <?php endif; ?>
          </h3>
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

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.voucher.create')); ?>" class="back-btn">
  <i class="icon" data-feather="x"></i>
</a>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
                             
                      



<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/vendor/voucher/log.blade.php ENDPATH**/ ?>