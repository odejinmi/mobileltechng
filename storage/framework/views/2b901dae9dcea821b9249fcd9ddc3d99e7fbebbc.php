<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="verification-code-wrapper">
                <div class="verification-area">
                    <h5 class="pb-3 text-center border-bottom"><?php echo app('translator')->get('2FA Verification'); ?></h5>
                    <form action="<?php echo e(route('user.go2fa.verify')); ?>" method="POST" class="submit-form">
                        <?php echo csrf_field(); ?>

                        <?php echo $__env->make($activeTemplate . 'partials.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="form--group">
                            <button type="submit" class="btn btn-primary submit-btn btn-block  btn-lg w-100"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/auth/authorization/2fa.blade.php ENDPATH**/ ?>