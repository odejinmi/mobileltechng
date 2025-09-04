<?php $__env->startSection('content'); ?>
<!--end::Authentication - Password Reset-->
<?php
$passwordContent = getContent('password.content', true);
?>
<!-- header starts -->
<div class="auth-header"style="background-color:#30003D;">
    <a href="<?php echo e(route('user.login')); ?>"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img1" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/authentication/4.svg')); ?>" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>Reset your password</h2>
        <h4 class="p-0">Add new one</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
  
  <form class="auth-form" method="POST"
  action="<?php echo e(route('user.password.update')); ?>">
  <?php echo csrf_field(); ?> 

  <input type="hidden" name="email" value="<?php echo e($email); ?>">
  <input type="hidden" name="token" value="<?php echo e($token); ?>">
    <div class="custom-container">
      <div class="form-group">
        <h5>Enter your new password, which must be different from your previous one.</h5>
        <label for="newpin" class="form-label">Enter new password</label>
        <div class="form-input">
          <input type="password" name="password" class="form-control" id="newpin" placeholder="Enter new password" />
        </div>
      </div>

      <div class="form-group">
        <label for="confirmpin" class="form-label">Re-enter new password</label>
        <div class="form-input">
          <input type="password"  name="password_confirmation" class="form-control" id="confirmpin" placeholder="Re-enter new password" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100">Update Password</button>
    </div>
  </form>
  <!-- login section start -->
    
<?php $__env->stopSection(); ?>
  

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/auth/passwords/reset.blade.php ENDPATH**/ ?>