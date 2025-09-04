<?php $__env->startSection('panel'); ?>


  <!-- Buy & Sell history section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Our Rate</h2>
        <a href="#"></a>
      </div>

      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="#" class="d-flex gap-3">
              <div class="transaction-imagse color1">
                <img class="img-fluids icons" src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e(@$data->image); ?>" width="40" alt="bitcoins" />
                
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e($data->name); ?></h5>
                  <h5 class="error-color"><small>Sell </small><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->sell_rate,2)); ?></h5>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"><?php echo e($data->symbol); ?></h5>
                  <h5 class="success-color"><small>Buy </small><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->buy_rate,2)); ?><span class="light-text"></span></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php echo emptyData2(); ?>

        <?php endif; ?> 
      </div>
    </div>
  </section>
  <!-- Transaction section end -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/assets/crypto/rates.blade.php ENDPATH**/ ?>