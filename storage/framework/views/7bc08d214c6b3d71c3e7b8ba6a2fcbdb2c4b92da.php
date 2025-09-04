<?php $__env->startSection('panel'); ?>

  <!-- person transaction list section starts -->
  <section class="section-b-space">
    <div class="custom-container"> 

      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="<?php echo e($data['explorer_url']); ?>" class="d-flex gap-3">
              <div class="transaction-image color1">
                <img class="img-fluid icon" src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e(@$coin->image); ?>" alt="bitcoins" />
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e($coin->name); ?></h5>
                  <h3 class="<?php if($data['type'] == 'receive'): ?> success-color  <?php else: ?>  error-color  <?php endif; ?>">$<?php echo e(number_format($data->usd,2)); ?></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class=" <?php if($data['type'] == 'receive'): ?> success-color  <?php else: ?>  error-color  <?php endif; ?>"><?php echo e(@strToUpper($data['type'])); ?></h5>
                  <h5 class=" <?php if($data['type'] == 'receive'): ?> success-color  <?php else: ?>  error-color  <?php endif; ?>"><?php echo e(showDate($data['date'])); ?></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php echo emptyData2(); ?>

        <?php endif; ?> 
      </div>
      <?php if($trx->hasPages()): ?>
      <br>
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          <?php echo e($trx->links()); ?>

      </ul>
  </nav> 
    <?php endif; ?>
    </div>
  </section>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="#" onclick="history.back()" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?> 

<?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/wallet/transactions.blade.php ENDPATH**/ ?>