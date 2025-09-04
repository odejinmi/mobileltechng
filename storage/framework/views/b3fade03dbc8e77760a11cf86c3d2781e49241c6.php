<?php $__env->startSection('content'); ?>
<!--end::Authentication - Password Reset-->
<?php
$passwordContent = getContent('password.content', true);
?>
<!-- header starts -->
<div class="auth-header"style="background-color:#30003D;">
    <a href="<?php echo e(route('user.login')); ?>"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/authentication/3.svg')); ?>" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>Forget your pin</h2>
        <h4 class="p-0">Don’t worry !</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
    <form  class="auth-form" method="POST"
                    action="<?php echo e(route('user.password.email')); ?>">
                    <?php echo csrf_field(); ?> 
    <div class="custom-container">
      <div class="form-group">
        <h5>To reset your password, enter your registered email.</h5>
        <label for="inputusername" class="form-label">Email</label>
        <div class="form-input">
          <input type="email" class="form-control" id="value" name="value" placeholder="Enter Your Email" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100">Reset Password</button>
    </div>
  </form>
  <!-- login section start -->
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/auth/passwords/email.blade.php ENDPATH**/ ?>