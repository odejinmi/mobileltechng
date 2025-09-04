
<?php $__env->startSection('panel'); ?>
 <!-- content @s
-->

  <!-- notification receive money section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="receive-money-box">
        <div class="receive-money-header">
          <div class="receive-money-img">
            <i class="icon" data-feather="download"></i>
          </div>
          <h2>Receive Money</h2>
        </div>
        <div class="receive-money-details">
          <ul class="details-list">
            <li>
              <h3 class="fw-normal dark-text">Type</h3>
              <h3 class="fw-normal theme-color"><?php echo e(__($account->account->name)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Details</h3>
              <h3 class="fw-normal light-text"> <?php echo e(__($account->account->details)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Currency</h3>
              <h3 class="fw-normal light-text"><?php echo e(__($account->account->currency)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Amount</h3>
              <h3 class="fw-normal light-text"><?php echo e(showAmount($account->amount)); ?> <?php echo e(__($account->account->currency)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Fee</h3>
              <h3 class="fw-normal light-text"><?php echo e(__($account->account->fee)); ?>%</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Rate</h3>
              <h3 class="fw-normal light-text">1 <?php echo e(__($account->account->currency)); ?> = <?php echo e(showAmount($account->rate)); ?>

                <?php echo e(__($general->cur_text)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Value</h3>
              <h3 class="fw-normal light-text"><?php echo e(showAmount($account->pay)); ?> <?php echo e(__($general->cur_text)); ?></h3>
            </li>
          </ul> 
        </div>
      </div>
    </div>
  </section>
      <!-- form section starts -->
      <section class="section-b-space">
        <div class="custom-container"> 
                <form action="" class="auth-form m-0" method="POST" class="text-centers"  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="custom-container">
                    <div class="form-group">
                        <div class="upload-image">
                            <input class="form-control upload-file" name="proof" type="file" id="formFileLg">
                            <h5 class="dark-text position-absolute fs-6">Upload proof of payment</h5>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn theme-btn w-100" type="button" id="submit"><?php echo app('translator')->get('Proceed'); ?>

            </form>

             
        </div>
    </section>
  <!-- notification receive money section starts -->

  
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/vendor/request_account/confirm.blade.php ENDPATH**/ ?>