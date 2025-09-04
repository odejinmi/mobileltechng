<?php $__env->startSection('content'); ?>

<?php
      $loginContent = getContent('login.content', true);
?>
<!-- header starts -->
<div class="auth-header">
    <a href="<?php echo e(url('/')); ?>"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/authentication/1.svg')); ?>" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>Welcome back !!</h2>
        <h4 class="p-0">Fill up the form</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
    <form class="auth-form" method="POST" action="<?php echo e(route('user.login')); ?>">
    <?php echo csrf_field(); ?> 
    <div class="custom-container">
      <div class="form-group">
        <label for="inputusername" class="form-label">Username</label>
        <div class="form-input">
          <input type="text" class="form-control" id="inputusername" name="username" placeholder="Enter Your Email" />
        </div>
      </div>

      <div class="form-group">
        <label for="inputpin" class="form-label">Password</label>
        <div class="form-input">
          <input type="password" name="password" class="form-control" id="inputpin" placeholder="Enter Your Password" />
        </div>
      </div>
      <div class="remember-option mt-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
          <label class="form-check-label" for="flexCheckDefault">Remember me</label>
        </div>
        <a class="forgot" href="<?php echo e(route('user.password.request')); ?>">Forgot Password?</a>
      </div>

      <button type="submit" class="btn theme-btn w-100">Sign In</button>
     
      <div class="division">
        <span>OR</span>
      </div>

      <a href="<?php echo e(route('user.register')); ?>" target="" class="btn gray-btn mt-3"> <img class="img-fluid google"
          src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/google.svg')); ?>" alt="google" /> Continue with Email</a>
      
    </div>
  </form>
  <!-- login section start -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>