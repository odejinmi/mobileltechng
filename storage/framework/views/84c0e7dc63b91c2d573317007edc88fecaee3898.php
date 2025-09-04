<?php $__env->startSection('panel'); ?>

   
   <!-- change password section start -->
   <section>
    <div class="custom-container">
      <h4 class="fw-normal light-text lh-base">Enter your current password and enter a new password to change your account passwords.
      </h4>
        <form class="auth-form pt-0 mt-3" class="form" novalidate="novalidate" action="<?php echo e(route('user.change.password')); ?>" method="POST"  enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for="inputpin" class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password" id="current_password" />        
          </div>
          
          <div class="form-group">
            <label for="inputpin" class="form-label">New Password</label>
            <input type="password" class="form-control" name="password" id="password" />        
          </div>
          <div class="form-group">
            <label for="inputpin" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />        
          </div>
  
            
        <button type="submit" class="btn theme-btn w-100">Change password</button>
      </form>
    </div>
  </section>
  <!-- change password section start -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?>
 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/password.blade.php ENDPATH**/ ?>