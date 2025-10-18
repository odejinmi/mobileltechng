<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title> <?php echo e($general->siteName(__($pageTitle))); ?></title>
    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="mpay" />
    <meta name="keywords" content="mpay" />
    <meta name="author" content="mpay" />
    <link rel="manifest" href="<?php echo e(asset($activeTemplateTrue . 'mobile/manifest.json')); ?>" />
    <meta name="theme-color" content="#122636" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="mpay" />
    <meta name="msapplication-TileImage" content="assets/images/logo/favicon.png" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/vendors/bootstrap.min.css')); ?>" />

    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/vendors/swiper-bundle.min.css')); ?>" />
 
    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/style.css')); ?>" />
    <?php echo $__env->yieldPushContent('style'); ?>

</head>

<body class="auth-body">

    <?php echo $__env->yieldContent('content'); ?>

  <!-- feather js -->
  <script src="<?php echo e(asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/feather.min.js')); ?>"></script>
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/custom-feather.js')); ?>"></script>

  <!-- bootstrap js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/bootstrap.bundle.min.js')); ?>"></script>

  <!-- script js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/script.js')); ?>"></script>
 
    <?php echo $__env->yieldPushContent('script'); ?>
    <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH D:\PhpstormProjects\mobileltechng\resources\mobileapp/templates/basic/layouts/auth.blade.php ENDPATH**/ ?>