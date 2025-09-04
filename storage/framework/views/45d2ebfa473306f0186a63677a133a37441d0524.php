<?php $__env->startSection('panel'); ?>

  <!-- monthly statistics section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banner1.png')); ?>" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')); ?>" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
     
    </div>
    </div>
  </section>
  <a href="<?php echo e(route('user.sellgift')); ?>">
  <section>
    <div class="custom-container">
      <div class="statistics-banner">
        <div class="d-flex justify-content-center gap-3">
          <div class="statistics-image">
            <i class="icon" data-feather="gift"></i>
          </div>
          <div class="statistics-content d-block">
            <h5>Sell Giftcards</h5> 
            <h6>To sell giftcard please click here</h6> 
          </div>
        </div>
      </div>
    </div>
  </section>
</a>
<a href="<?php echo e(route('user.buygift')); ?>">
  <section>
    <div class="custom-container">
      <div class="statistics-banner">
        <div class="d-flex justify-content-center gap-3">
          <div class="statistics-image">
            <i class="icon" data-feather="shopping-cart"></i>
          </div>
          <div class="statistics-content d-block">
            <h5>Buy Giftcards</h5> 
                <h6>To buy giftcard please click here</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
</a>

  <!-- monthly statistics section end -->


  <!-- bill details section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Recent Trades</h2>
        <a href="<?php echo e(route('user.giftcard.log')); ?>" >See All</a>
      </div>
      <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $gcard = App\Models\Giftcard::whereId($data->card_id)->first();
        ?>
        <div class="col-md-3 col-6">
          <div class="bill-box">
            <div class="d-flex gap-3">
              <div class="bill-icon">
                <img class="img-fluid icon" src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e(@$gcard->image); ?>" alt="p6" />
              </div>
              <div class="bill-details">
                <h5 class="dark-text"><?php echo e(@$gcard->name); ?></h5>
                <h6 class="light-text mt-2"><?php echo e(Carbon\Carbon::parse($data->updated_at)->diffForHumans()); ?></h6>
              </div>
            </div>
            <div class="bill-price">
              <h5><?php echo e($data->country); ?><?php echo e($data->amount); ?></h5>
              <?php if($data->status == 1): ?>
              <span
                  class="badge bg-success">Approved</span>
                <?php elseif($data->status == 0): ?>
                    <span
                        class="badge bg-warning">Pending</span>
                <?php elseif($data->status == 2): ?>
                    <span
                        class="badge bg-danger">Declined</span>
                <?php endif; ?>
                    
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
         
    
      </div>
    </div>
  </section>
  <!-- bill details section starts -->

  <!-- news-update section starts -->
  
    <?php $__env->stopSection(); ?> 
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/giftcard/index.blade.php ENDPATH**/ ?>