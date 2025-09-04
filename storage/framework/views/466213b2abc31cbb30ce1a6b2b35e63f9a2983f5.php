<?php $__env->startSection('content'); ?>
    <?php
        $loginContent = getContent('login.content', true);
    ?>
    <!-- header starts -->
    <div class="auth-header" style="background-color:#30003D;">
        <a href="<?php echo e(url('/')); ?>"> <i class="back-btn" data-feather="arrow-left"></i> </a>

        <img class="img-fluid img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/authentication/1.svg')); ?>"
            alt="v1" />

        <div class="auth-content">
            <div>
                <h2>Welcome back !!</h2>
                <h4 class="p-0">Fill up the form</h4>
            </div>
        </div>
    </div>
    <!-- header end -->

    <!-- login section start -->
    <form class="auth-form" method="POST" id="login" action="<?php echo e(route('user.login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="custom-container">
            <div class="form-group">
                <label for="inputusername" class="form-label">Username</label>
                <div class="form-input">
                    <input type="text" class="form-control" id="inputusername" name="username"
                        placeholder="Enter Your Username" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputpin" class="form-label">Password</label>
                <div class="form-input">
                    <input type="password" name="password" class="form-control" id="inputpin"
                        placeholder="Enter Your Password" />
                </div>
            </div>
            <div class="remember-option mt-3">
                <a class="forgot" href="<?php echo e(route('user.password.request')); ?>">Forgot Password?</a>
            </div>

            <button type="button" id="button" style="background-color:#30003D;" class="btn theme-btn w-100" onclick="loadbutton()">Sign In</button>
            <div id="loader"></div>
            <div class="division">
                <span>OR</span>
            </div>

            <a href="<?php echo e(route('user.register')); ?>" target="" class="btn gray-btn mt-3"> <img class="img-fluid google"
                    src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/google.svg')); ?>" alt="google" /> Signup Account</a>

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
            document.getElementById("login").submit();

        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\mobileltechng\resources\mobileapp/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>