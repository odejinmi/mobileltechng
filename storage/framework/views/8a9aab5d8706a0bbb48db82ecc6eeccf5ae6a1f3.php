
<?php $__env->startSection('panel'); ?> 

  <!-- my account section start -->
  <section class="section-b-space">
    <div class="custom-container">
       <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')); ?>" alt="p3" />
          </div>
        </div>
         
          <form action="<?php echo e(route('user.post_withdraw.card', $vcards->card_id)); ?>" class="auth-form pt-0 mt-3" method="post" enctype="multipart/form-data">
               <?php echo csrf_field(); ?> 
              <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
              <?php endif; ?> 
        
        <div class="form-group">
          <label for="inputusername" class="form-label">Amount <b>(USD)</b></label>
          <div class="form-input">
                    <input type="text" class="form-control" name="amount" required="">

          </div>
        </div>
         

        <button type="submit" class="btn theme-btn w-100">Withdraw</button>
      </form>
    </div>
  </section>
  <!-- my account section end -->

  
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/virtual_card/withdraw.blade.php ENDPATH**/ ?>