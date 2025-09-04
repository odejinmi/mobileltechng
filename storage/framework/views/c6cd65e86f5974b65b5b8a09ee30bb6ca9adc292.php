
<?php $__env->startSection('content'); ?>

<!-- header starts -->
<div class="auth-header">
    <a href="#"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/authentication/1.svg')); ?>" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>Personal identity</h2>
        <h4 class="p-0">Fill up the form</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
    <form method="POST" class="auth-form" action="<?php echo e(route('user.data.submit')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> 
    <div class="custom-container">
      <div class="form-group">
        <label for="inputusername" class="form-label"><?php echo app('translator')->get('First Name'); ?></label>
        <div class="form-input">
            <input type="text" class="form-control form-control-solid" name="firstname" value="<?php echo e(old('firstname')); ?>" placeholder="<?php echo app('translator')->get('Enter First Name'); ?>" required />
        </div>
      </div>

      <div class="form-group">
        <label for="inputpin" class="form-label"><?php echo app('translator')->get('Last Name'); ?></label>
        <div class="form-input">
            <input type="text" class="form-control form-control-solid" name="lastname" value="<?php echo e(old('lastname')); ?>" placeholder="<?php echo app('translator')->get('Enter Last Name'); ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label for="inputday" class="form-label"><?php echo app('translator')->get('Address'); ?></label>
        <div class="form-input">
        <input type="text" class="form-control form-control-solid"  name="address" value="<?php echo e(old('address')); ?>"placeholder="<?php echo app('translator')->get('Enter Your Address'); ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="inputgender" class="form-label"><?php echo app('translator')->get('State'); ?> </label>
        <input type="test" class="form-control form-control-solid" name="state" value="<?php echo e(old('state')); ?>"placeholder="<?php echo app('translator')->get('Enter Your State'); ?>" />
      </div>
      <div class="form-group">
        <div class="upload-image">
            <input class="form-control upload-file" type="file" name="image" accept=".png, .jpg, .jpeg" id="formFileLg">
            <h5 class="dark-text position-absolute fs-6">Upload your photo</h5>
        </div>
       </div>

      <button type="submit" class="btn theme-btn w-100">Continue</button>
      <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-link mt-3">Logout</a>
    </div>
  </form>
  <!-- login section start -->
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/user_data.blade.php ENDPATH**/ ?>