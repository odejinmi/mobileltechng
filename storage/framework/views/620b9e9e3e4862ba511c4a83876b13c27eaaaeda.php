<?php $__env->startSection('panel'); ?>



  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/loan1.png')); ?>" alt="banner2" />
            </a>
          </div> 
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/loan2.png')); ?>" alt="banner2" />
            </a>
          </div> 

          
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->

  <!-- pay-successfully section starts -->
  <?php if(session()->has('done')): ?>

  <section class="section-b-space">
    <div class="custom-container">
      <div class="successfully-pay">
        <img class="img-fluid pay-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/gif/successfull-payment.gif')); ?>" alt="Payment" />
      </div> 
    </div>
  </section>
  <!-- pay-successfully section end -->
  <?php else: ?>
  <!-- pay money section starts -->
  <section class="pay-money section-b-space">
    <div class="custom-container">
        <form action="<?php echo e(route('user.loan.apply')); ?>" method="post"> 
        <?php echo csrf_field(); ?> 

      <div class="profile-pic">
        <img class="img-fluid img" src="<?php echo e(asset('assets/assets/dist/images/backgrounds/2.png')); ?>" alt="p3" />
      </div> 
      <h3 class="person-name">Paying money to <?php echo e(auth()->user()->fullname); ?></h3>
      <h5 class="upi-id">APP ID : <?php echo e(auth()->user()->username); ?></h5>
     

      <ul class="card-list">
        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li class="payment-add-box mb-1">
          <div class="add-img">
            <i class="icon text-primary" data-feather="gift"></i>
          </div>
          <div class="add-content">
            <div>
              <h5 class="fw-semibold dark-text"><?php echo e(__(@$plan->name)); ?></h5>
              <h6 class="mt-2 light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(__(showAmount($plan->minimum_amount))); ?> - <?php echo e(__($general->cur_sym)); ?><?php echo e(__(showAmount($plan->maximum_amount))); ?></h6>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="<?php echo e($plan->id); ?>" name="plan" />
            </div>
          </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php echo emptyData(); ?>

        <?php endif; ?>
      </ul>
      <div class="form-group">
        <div class="form-input mt-4">
          <input type="number" class="form-control" name="amount"  id="inputamount" placeholder="0.00" />
        </div>
      </div>
      <div class="form-group">
        <div class="form-input mt-3">
          <input type="text" class="form-control reason" name="reason" id="inputreason" placeholder="Enter reason" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100">Request</button>
    </form>
    </div>
  </section>
  <?php endif; ?>
  <!-- pay money section end -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.loan.list')); ?>" class="back-btn">
    <i class="icon" data-feather="printer"></i>
  </a>
<?php $__env->stopPush(); ?>

 
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/loan/plans.blade.php ENDPATH**/ ?>