<?php $__env->startSection('panel'); ?>
<section class="section-b-space">
    <div class="custom-container"> 
  
      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = @$withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail<?php echo e($data->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <i class="icon" data-feather="printer"></i>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e(__($data->trx)); ?></h5>
                  <h3 class="<?php if($data->status == Status::PAYMENT_SUCCESS): ?> success-color <?php else: ?> error-color <?php endif; ?>"> <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->amount)); ?><span></span></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"><?php echo e(__($data->method?->name)); ?></h5>
                  <h5 class="light-text"><?php echo e(diffForHumans($data->created_at)); ?></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
  
  
  <!-- transaction detail modal start -->
  <div class="modal successful-modal transfer-details fade" id="transaction-detail<?php echo e($data->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Request Detail</h2>
        </div>
        <div class="modal-body">
          <ul class="details-list">
            <li>
              <h3 class="fw-normal dark-text">Status</h3>
              <h3 class="fw-normal light-text">
                <?php if($data->status == 2): ?>
                <span class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
            <?php elseif($data->status == 1): ?>
                <span class="badge bg-success"><?php echo app('translator')->get('Completed'); ?></span>
                <button class="btn btn-info btn-rounded  badge approveBtn"
                    data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                        class="fa fa-info"></i></button>
            <?php elseif($data->status == 3): ?>
                <span class="badge bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                <button class="btn btn-info btn-rounded badge approveBtn"
                    data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                        class="fa fa-info"></i></button>
            <?php endif; ?>
              </h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Date</h3>
              <h3 class="fw-normal light-text"><?php echo e(showDateTime($data->created_at)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Time</h3>
              <h3 class="fw-normal light-text"><?php echo e(diffForHumans($data->created_at)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Amount </h3>
              <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->amount)); ?></h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Fee</h3>
              <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->charge)); ?></h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Rate</h3>
              <h3 class="fw-normal light-text">
                1 <?php echo e(__($general->cur_text)); ?> = <?php echo e(showAmount($data->rate)); ?> <?php echo e(__($data->currency)); ?>

              </h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Final Amount</h3>
              <h3 class="fw-normal light-text"><?php echo e(showAmount($data->final_amount)); ?>

                <?php echo e(__($data->method_currency)); ?></h3>
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
      <?php if($withdraws->hasPages()): ?>
      <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            <?php echo e($withdraws->links()); ?>

        </ul>
    </nav> 
      <?php endif; ?>
       
    </div>
  </section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.withdraw')); ?>" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?> 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/withdraw/log.blade.php ENDPATH**/ ?>