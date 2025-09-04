<?php $__env->startSection('panel'); ?>

   
  <!-- profile section start -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>" alt="p3" />
          </div>
        </div>
        <h2><?php echo e($user->fullname); ?></h2>
        <h5><?php echo e($user->email); ?></h5>
      </div>

      <ul class="profile-list">
        <li>
          <a href="<?php echo e(route('user.change.profile')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="user"></i>
            </div>
            <div class="profile-details">
              <h4>My Account</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('user.change.trxpassword')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="key"></i>
            </div>
            <div class="profile-details">
              <h4>Transaction PIN</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('user.change.password')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="settings"></i>
            </div>
            <div class="profile-details">
              <h4>Change Password</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('user.twofactor')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="camera"></i>
            </div>
            <div class="profile-details">
              <h4>2FA</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>

        <li>
          <a href="<?php echo e(route('ticket.open')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="help-circle"></i>
            </div>
            <div class="profile-details">
              <h4>Help Center</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo e(route('user.logout')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="log-out"></i>
            </div>
            <div class="profile-details">
              <h4>Log Out</h4>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </section>
  <!-- profile section end -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                SlimNotifierJs.notification('success', 'Copied', '2FA Code Copied Successfuly', 3000);

                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/profile_setting.blade.php ENDPATH**/ ?>