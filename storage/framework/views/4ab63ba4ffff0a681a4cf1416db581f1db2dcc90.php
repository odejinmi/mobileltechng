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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/partials/notify.blade.php ENDPATH**/ ?>