
<?php $__env->startSection('content'); ?>
   <!-- header starts -->
  <div class="auth-header" style="background-color:#30003D;">
    <a href="<?php echo e(route('user.login')); ?>"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/authentication/6.svg')); ?>" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>Welcome back !!</h2>
        <h4 class="p-0">Fill up the form</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
  <form class="auth-form" method="POST" id="register" action="<?php echo e(route('user.register')); ?>">
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
        <label for="inputusername" class="form-label">Email id</label>
        <div class="form-input">
          <input type="email" class="form-control" name="email" id="inputemail" placeholder="Enter Your Email" />
        </div>
      </div>
      <div class="form-group">
        <label for="inputusername" class="form-label">Mobile</label>
        <div class="form-input">
          <input type="number" class="form-control" name="mobile" id="inputmobile" placeholder="Enter Your Phone" />
        </div>
      </div>


      <div class="form-group">
        <label for="inputusername" class="form-label">NIN</label>
        <div class="form-input">
          <input type="number" class="form-control" name="nin" id="nin" placeholder="Enter Your NIN" />
        </div>
      </div>


      <div class="form-group">
        <label for="inputusername" class="form-label">Username</label>
        <div class="form-input">
          <input type="text" class="form-control" name="username" id="inputusername" placeholder="Enter Your Username" />
        </div>
      </div>

      <div class="form-group">
        <label for="newpin" class="form-label">Enter new password</label>
        <div class="form-input">
          <input type="password" name="password" class="form-control" id="newpin" placeholder="Enter password" />
        </div>
      </div>

      <div class="form-group">
        <label for="confirmpin" class="form-label">Re-enter new password</label>
        <div class="form-input">
          <input type="password" class="form-control"  name="password_confirmation" id="confirmpin" placeholder="Re-enter password" />
        </div>
      </div>

      <button type="button" id="button" class="btn theme-btn w-100" onclick="loadbutton()">Sign Up</button>
            <div id="loader"></div>
    </div>
  </form>
  <!-- login section start -->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function loadbutton() {
            $("#loader").html(
                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
            );
            document.getElementById("button").disabled = true;
            document.getElementById("register").submit();

        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>