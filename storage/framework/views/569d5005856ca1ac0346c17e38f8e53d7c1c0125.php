<?php $__env->startSection('panel'); ?>

   
   <!-- change password section start -->
   <section>
    <div class="custom-container">
      <h4 class="fw-normal light-text lh-base">Enter your current password and enter a new transaction PIN to change your account PIN.
      </h4>
        <form class="auth-form pt-0 mt-3" class="form" novalidate="novalidate" action="<?php echo e(route('user.change.trxpassword')); ?>" method="POST"  enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <label for="inputpin" class="form-label">Current Password</label>
            <input type="password" class="form-control" name="password" id="password" />        
          </div>
          
          <div class="form-group">
            <label for="inputpin" class="form-label">New PIN</label>
            <input type="number" maxlengh="6" class="form-control" name="pin" id="pin" />        
          </div> 
  
            
        <button type="submit" class="btn theme-btn w-100">Update PIN</button>
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
 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/trxpassword.blade.php ENDPATH**/ ?>