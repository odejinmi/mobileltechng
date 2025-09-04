
<?php $__env->startSection('panel'); ?> 

<!-- login section start -->
<form action="" class="auth-form" method="post" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>  
  <div class="custom-container">
 
    <div class="form-group">
      <div class="upload-image rounded-image">
        <label for="formFileLg" class="form-label d-none">file </label>
        <input class="form-control upload-file" name="front" type="file" id="formFileLg">
        <?php if($user->kyc_complete == 3 || $user->kyc_complete == 1): ?>
        <img src="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e($user->username); ?>/front_kyc_image.png" alt="" class="img-fluid rounded-circle" width="120" height="120">
        <?php else: ?>
        <i class="upload-icon dark-text" data-feather="camera"></i>
        <?php endif; ?>
      </div>
    </div>

    <h3 class="info-id">To confirm your information, upload front view of your ID.</h3>

    <div class="form-group">
      <div class="upload-image rounded-image">
        <input class="form-control upload-file" type="file" name="back" id="formFileLg">
        <?php if($user->kyc_complete == 3 || $user->kyc_complete == 1): ?>
        <img src="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e($user->username); ?>/back_kyc_image.png" alt="" class="img-fluid rounded-circle" width="120" height="120">
        <?php else: ?>
        <i class="upload-icon dark-text" data-feather="camera"></i>
        <?php endif; ?>
      </div>
    </div>
    <h3 class="info-id border-0 pb-0">To confirm your information, upload back view of your ID.</h3>

    <div class="form-group">
      <?php if($user->kyc_complete == 3 || $user->kyc_complete == 1): ?>
      <div class="text-center">
        <p class="mb-0"><?php echo e(@$user->kyc->type); ?></p>
        <?php if($user->kyc_complete == 3): ?>
        <badge class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></badge>
        <?php elseif($user->kyc_complete == 1): ?>
        <badge class="badge bg-success"><?php echo app('translator')->get('Approved'); ?></badge>
        <?php endif; ?>
      </div>
      <?php else: ?>
      <label for="exampleInputPassword1" class="form-label fw-semibold"><?php echo app('translator')->get('Document Type'); ?></label>
      <select name="type"
      class="select2 form-control form-control-lg"
      style="width: 100%; height: 36px"
      >
      <option>Select</option>
      <option>Voters Card</option>
      <option>Drivers Licence</option>
      <option>Work ID Card</option>
      <option>International Passport</option>
      <option>Drivers Licence</option>
      <option>Passport Photograph</option>
      <option>Address Utility Bill</option>
      <option>NIN Card</option>
      </select>
      <?php endif; ?>
    </div>

    <?php if($user->kyc_complete == 0 || $user->kyc_complete == 2): ?>
    <button type="submit" class="btn theme-btn w-100">Upload Document</button>
    <?php endif; ?>
  </div>
</form>
<!-- login section start -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/kyc/index.blade.php ENDPATH**/ ?>