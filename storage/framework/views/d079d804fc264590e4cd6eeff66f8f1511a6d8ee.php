<?php $__env->startSection('panel'); ?>

   <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/sellcrypto.png')); ?>" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/buycrypto.png')); ?>" style="height:100%;" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
     
    </div>
    </div>
  </section>
  <!-- banner section end -->
   
  <!-- categories section starts -->
  <section class="categories-section section-b-space">
    <div class="custom-container">
      <ul class="categories-list">
        <li>
          <a href="<?php echo e(route('user.crypto.buy')); ?>">
            <div class="categories-box">
              <i class="categories-icon" data-feather="shopping-cart"></i>
            </div>
            <h5 class="mt-2 text-center">Buy</h5>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('user.crypto.sell')); ?>">
            <div class="categories-box">
              <i class="categories-icon" data-feather="shopping-bag"></i>
            </div>
            <h5 class="mt-2 text-center">Sell</h5>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('user.crypto.rates')); ?>">
            <div class="categories-box">
              <i class="categories-icon" data-feather="bar-chart-2"></i>
            </div>
            <h5 class="mt-2 text-center">Rate</h5>
          </a>
        </li>

        <li>
          <a href="<?php echo e(route('user.crypto.index')); ?>">
            <div class="categories-box">
              <i class="iconsax categories-icon" data-icon="bank"></i>
            </div>
            <h5 class="mt-2 text-center">Wallet</h5>
          </a>
        </li>
      </ul>
    </div>
  </section>
  <!-- categories section end -->

   

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
 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/assets/crypto/index.blade.php ENDPATH**/ ?>