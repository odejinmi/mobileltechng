
<?php $__env->startSection('panel'); ?>

  <!-- my account section start -->
  <section class="section-b-space">
    <div class="custom-container">
        <?php if(!empty($customer)): ?>
      <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')); ?>" alt="p3" />
          </div>
        </div>
        <h2>First Name:  <?php if(isset($customer->first_name)): ?><?php echo e($customer->first_name); ?><?php endif; ?></h2>
        <h2>Last Name:  <?php if(isset($customer->last_name)): ?><?php echo e($customer->last_name); ?><?php endif; ?></h2>
        <h2>Email:  <?php if(isset($customer->customer_email)): ?><?php echo e($customer->customer_email); ?><?php endif; ?></h2>
        <h2>Phone: <?php if(isset($customer->phone_number)): ?><?php echo e($customer->phone_number); ?><?php endif; ?></h2>
        <h2>DOB: <?php if(isset($customer->date_of_birth)): ?><?php echo e($customer->date_of_birth); ?><?php endif; ?></h2>
        <h2>House Number: <?php if(isset($customer->house_number)): ?><?php echo e($customer->house_number); ?><?php endif; ?></h2>
        <h5>Customer ID: <?php if(isset($customer->bitvcard_customer_id)): ?><?php echo e($customer->bitvcard_customer_id); ?><?php endif; ?></h5>
      </div>
      <?php else: ?>

          <form action="<?php echo e(route('user.create.customer.add')); ?>" class="auth-form pt-0 mt-3" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="inputpin" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" name="phone_number">

        </div>

        <div class="form-group">
          <label for="inputusername" class="form-label">Date Of Birth</label>
          <div class="form-input">
                                  <input type="text" class="form-control" name="date_of_birth">

          </div>
        </div>
        <div class="form-group">
          <label for="inputusername" class="form-label">Address</label>
          <div class="form-input">
                        <input type="text" class="form-control" name="line">

          </div>
        </div>
        <div class="form-group">
          <label for="inputusername" class="form-label">Zip Code</label>
          <div class="form-input">
                        <input type="text" class="form-control" name="zip_code">

          </div>
        </div> 

        <button type="submit" class="btn theme-btn w-100">Create CardHolder</button>
      </form>
      <?php endif; ?>
    </div>
  </section>
  <!-- my account section end -->



<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/virtual_card/create.blade.php ENDPATH**/ ?>