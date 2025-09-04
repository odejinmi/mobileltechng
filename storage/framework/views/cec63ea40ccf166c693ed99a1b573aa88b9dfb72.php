<?php $__env->startSection('panel'); ?>
<!-- person transaction list section starts -->
<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
      <?php $__empty_1 = true; $__currentLoopData = $saved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12">
        <div class="transaction-box">
          <a href="<?php echo e(route('user.viewsaved',$data->reference)); ?>" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e(__($data->reference)); ?></h5>
                <?php if($data->status == 1): ?>
                <span class="badge rounded-pill bg-warning me-1"><?php echo app('translator')->get('Running'); ?></span>
                <?php elseif($data->status == 0): ?>
                    <span class="badge rounded-pill bg-success me-1"><?php echo app('translator')->get('Completed'); ?></span>
                <?php endif; ?>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text"><?php if($data->type == 1): ?> Recurrent Savings  <?php elseif($data->type == 2): ?> Target Savings  <?php elseif($data->type == 3): ?> Fixed Savings <?php endif; ?></h5>
                <h5 class="light-text"><?php echo e(diffForHumans($data->created_at)); ?></h5>
              </div>
            </div>
          </a>
        </div>
      </div> 
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <?php echo emptyData2(); ?>

      <?php endif; ?>
    </div>
    <?php if($saved->hasPages()): ?>
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          <?php echo e($saved->links()); ?>

      </ul>
  </nav> 
    <?php endif; ?>
     
  </div>
  <?php $__env->startPush('script'); ?>
  <script>
    function redirect(url)
    {
        window.location.href = url;
    }
  </script>
  <?php $__env->stopPush(); ?>
</section>
<?php $__env->stopSection(); ?>
<!-- person transaction list section end -->
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/vendor/savings/log.blade.php ENDPATH**/ ?>