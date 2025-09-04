<?php $__env->startSection('panel'); ?>

  <!-- pay money section starts -->
  <section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" style=""  onerror="this.onerror=null; this.src='<?php echo e(getImage(getFilePath('logoIcon') . '/default.png')); ?>'" src="<?php echo e($qrCodeUrl); ?>" alt="p3" />
      </div>
      <h3 class="person-name"> <?php if(auth()->user()->ts): ?>  <?php echo app('translator')->get('Disabled Google 2FA'); ?> <?php else: ?>  <?php echo app('translator')->get('Enable Google 2FA'); ?> <?php endif; ?></h3>
      <h5 class="upi-id">
        <?php if(!auth()->user()->ts): ?>
        <!--begin::Description-->
          <?php echo app('translator')->get('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device'); ?> <a class="text--base"
          href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
          target="_blank">Download</a>
        <?php endif; ?>
      </h5>
      
      <?php if(auth()->user()->ts): ?>
        <form class="form" action="<?php echo e(route('user.twofactor.disable')); ?>" method="POST">
        <?php else: ?>
        <form class="form" action="<?php echo e(route('user.twofactor.enable')); ?>" method="POST">
        <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="form-group mt-3">
          <div class="form-input" id="copyBoard">
            <input type="text" name="key"  value="<?php echo e($secret); ?>" readonly class="form-control referralURL" id="copyBoard">
          </div>
        </div>

      <div class="form-group">
        <div class="form-input mt-3">
          <input type="text" class="form-control reason referralURL" name="code" placeholder="Enter authentication code" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100"> <?php if(auth()->user()->ts): ?> Disabled <?php else: ?> Enable <?php endif; ?></button>
    </div>
  </section>
  <!-- pay money section end -->


    
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
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
        <i class="icon" data-feather="x"></i>
    </a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/twofactor.blade.php ENDPATH**/ ?>