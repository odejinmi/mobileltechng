
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title> Error</title>
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
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/vendors/iconsax.css')); ?>" />

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/vendors/bootstrap.min.css')); ?>" />

    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/vendors/swiper-bundle.min.css')); ?>" />
 
    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/style.css')); ?>" />
    <?php echo $__env->yieldPushContent('style'); ?>

</head>

<body>
  <!-- header start -->
  <header class="section-t-space">
    <div class="custom-container">
      <div class="header-panel">
        <a href="<?php echo e(route('user.home')); ?>" class="back-btn">
          <i class="icon" data-feather="arrow-left"></i>
        </a>
        <h2>Notification</h2>
      </div>
    </div>
  </header>
  <!-- header end -->

  <!-- pay-successfully section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="empty-page">
        <img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/no-internet.svg')); ?>" alt="notification" />
        <h2 class="dark-text fw-semibold mt-3">Oops ! No Internet</h2>
        <h3 class="d-block fw-normal light-text text-center mt-2">Please check your internet connection & try again
          later.</h3>
      </div>
    </div>
  </section>
  <!-- pay-successfully section end -->

  <script src="<?php echo e(asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')); ?>"></script>

  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/swiper-bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/custom-swiper.js')); ?>"></script>

  <!-- feather js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/feather.min.js')); ?>"></script>
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/custom-feather.js')); ?>"></script>

  <!-- iconsax js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/iconsax.js')); ?>"></script>

  <!-- bootstrap js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/bootstrap.bundle.min.js')); ?>"></script>

  <!-- homescreen popup js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/homescreen-popup.js')); ?>"></script>

  <!-- PWA offcanvas popup js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/offcanvas-popup.js')); ?>"></script>

  <!-- script js -->
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/script.js')); ?>"></script>
</body>

</html><?php /**PATH D:\PhpstormProjects\mobileltechng\resources\mobileapp/errors/404.blade.php ENDPATH**/ ?>