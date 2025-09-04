<script src="<?php echo e(asset('assets/global/js/slim_notifier.js')); ?>"></script>
<?php if(session()->has('notify')): ?>
    <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            "use strict";
            SlimNotifierJs.notification('<?php echo e($msg[0]); ?>', '<?php echo e(__($msg[0])); ?>', '<?php echo e(__($msg[1])); ?>', 3000);
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if(session()->has('error')): ?>
    <script>
        "use strict";
        SlimNotifierJs.notification('error', 'Oops', "<?php echo e(session('error')); ?>", 3000);
    </script>
<?php endif; ?>
<?php if(session()->has('success')): ?>
    <script>
        "use strict";
        SlimNotifierJs.notification('success', 'Oops', "<?php echo e(session('success')); ?>", 3000);
    </script>
<?php endif; ?>
<script></script>
<?php if(isset($errors) && $errors->any()): ?>
    <?php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    ?>

    <script>
        "use strict";
        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            SlimNotifierJs.notification('error', 'Oops', '<?php echo e(__($error)); ?>', 3000);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>
<script>
    "use strict";

    function notify(status, message) {
        SlimNotifierJs.notification([status], 'Hello', message, 3000);
    }
</script> 

<script>
    $(document).ready(function() {
        $('#notfound').modal('show');
    } );
</script>
<?php if(session()->has('notfound')): ?>
   <!-- error modal starts -->
   <div class="modal error-modal fade" id="404" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Not Available</h2>
            </div>
            <div class="modal-body">
                <div class="error-img">
                    <img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/error.svg')); ?>" alt="error" />
                </div>
                <h3><?php echo e(session('notfound')); ?></h3>
            </div>
            <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                <i class="icon" data-feather="x"></i>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- error modal starts -->
<div class="modal error-modal fade" id="soon" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Coming Soon</h2>
            </div>
            <div class="modal-body">
                <div class="error-img">
                    <img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/error.svg')); ?>" alt="error" />
                </div>
                <h3>This feature is not available at the moment</h3>
            </div>
            <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                <i class="icon" data-feather="x"></i>
            </button>
        </div>
    </div>
</div>
<!-- error modal starts -->
<?php /**PATH C:\Users\DELL\PhpstormProjects\mobileltechng\resources\mobileapp/partials/notify.blade.php ENDPATH**/ ?>