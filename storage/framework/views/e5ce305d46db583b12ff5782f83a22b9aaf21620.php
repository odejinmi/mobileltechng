<?php $__env->startSection('panel'); ?>
    <!-- change password section start -->
    <section>
        <div class="custom-container"> 

            <form class="auth-form pt-0 mt-3" class="form" novalidate="novalidate" action="" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <div class="upload-image rounded-image">
                    <label for="formFileLg" class="form-label d-none">Avatar </label>
                    <input class="form-control upload-file" type="file" name="image" accept=".png, .jpg, .jpeg" id="formFileLg">
                      
                    <i class="upload-icon dark-text" data-feather="camera"></i>
                  </div>
                </div>

                <div class="form-group">
                    <label for="inputpin" class="form-label">First Name</label>
                    <input type="text" class="form-control mb-3 mb-lg-0"
                        placeholder="First name" name="firstname" value="<?php echo e($user->firstname); ?>" />
                </div>

                <div class="form-group">
                    <label for="inputpin" class="form-label">Last Name</label>
                    <input type="text" class="form-control " placeholder="Last name"
                        name="lastname" value="<?php echo e($user->lastname); ?>" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Gender</label>
                    <select name="gender" aria-label="Select a Gender" <?php if(@$user->gender != null): ?> readonly <?php endif; ?>
                        data-control="select2" data-placeholder="Select a gender..."
                        class="form-select">
                        <option selected disabled>Select Gender</option>
                        <option <?php if(@$user->gender == 'Male'): ?> selected <?php endif; ?> value="Male">Male</option>
                        <option <?php if(@$user->gender == 'Female'): ?> selected <?php endif; ?> value="Male">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Date Of Birth</label>
                    <input type="text" placeholder="YYYY-MM-DD" class="form-control "
                        name="dob" value="<?php echo e($user->dob); ?>" <?php if($user->dob != null): ?> readonlys <?php endif; ?> />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">City</label>
                    <input type="text" class="form-control " name="city"
                        value="<?php echo e($user->address->city); ?>" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Zip Code</label>
                    <input type="text" class="form-control " name="zip"
                        value="<?php echo e($user->address->zip); ?>" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Address</label>
                    <input type="text" class="form-control " name="address"
                        value="<?php echo e($user->address->address); ?>" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">State</label>
                    <input type="text" class="form-control " name="state"
                        value="<?php echo e($user->address->state); ?>" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Country</label>
                    <select name="country" aria-label="Select a Country" data-control="select2"
                        data-placeholder="Select a country..." class="form-select">
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(@$user->address->country == $country->country): ?> selected <?php endif; ?> value="<?php echo e($country->country); ?>"
                                data-code="<?php echo e($key); ?>">
                                <?php echo e(__($country->country)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                  <ul class="notification-setting">
                    <li class="setting-title">
                      <div class="notification pt-0">
                        <h3 class="fw-semibold dark-text">Notification</h3>
                      </div>
                    </li>
            
                    <li>
                      <div class="notification">
                        <h5 class="fw-normal dark-text">Email Notification</h5>
                        <div class="switch-btn">
                          <input type="checkbox" <?php if($user->en == 1): ?> checked <?php endif; ?> type="checkbox"
                          name="en" value="1"  />
                        </div>
                      </div>
                    </li>
            
                    <li>
                      <div class="notification">
                        <h5 class="fw-normal dark-text">SMS Notification</h5>
                        <div class="switch-btn">
                          <input type="checkbox" <?php if($user->sn == 1): ?> checked <?php endif; ?> type="checkbox"
                          name="sn" value="1" />
                        </div>
                      </div>
                    </li> 
                  </ul>
                </div>


                <button type="submit" class="btn theme-btn w-100">Update Account</button>
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

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/profile.blade.php ENDPATH**/ ?>