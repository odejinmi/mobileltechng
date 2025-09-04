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
        <link rel="stylesheet" id="change-link" type="text/css" href="<?php echo e(asset($activeTemplateTrue . 'mobile/css/select2.css')); ?>" />
    
    <?php echo $__env->yieldPushContent('style'); ?>

</head>

<body class="">
<!-- side bar start -->
<div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
    <div class="offcanvas-header sidebar-header">
      <div class="sidebar-logo">
        <img class="img-fluid losgo" src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'))); ?>"  width="30" alt="logo" />
      </div>
      <div class="balance img-fluid balance-bg" style="background-color:#30003D;">
        <div class="img-fluid balance-bg" alt="auth-bg" /></div>
        <h5></h5>
        <h2><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->balance)); ?></h2>
      </div>
    </div>
    <div class="offcanvas-body">
      <div class="sidebar-content">
        <ul class="link-section">
          <li>
            <a href="<?php echo e(route('user.kyc.index')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="shield"></i>
              <h3>Verification</h3>
            </a>
          </li>
          <?php if($general->buy_giftcard > 0 || $general->sell_giftcard > 0): ?>
          <li>
            <a href="<?php echo e(route('user.tradegift')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="gift"></i>
              <h3>Giftcard</h3>
            </a>
          </li>
          <?php endif; ?>
          <?php if($general->loan > 0): ?>
          <li>
            <a href="<?php echo e(route('user.loan.plans')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="percent"></i>
              <h3>Loans</h3>
            </a>
          </li>
          <?php endif; ?>
          <?php if($general->savings): ?>
          <li>
            <a href="<?php echo e(route('user.savings.start.new')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="shopping-bag"></i>
              <h3>Savings</h3>
            </a>
          </li>
          <?php endif; ?>
          <?php if($general->virtualcard): ?>
          <li>
            <a href="<?php echo e(route('user.virtualcard.index')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="credit-card"></i>
              <h3>Virtual Card <b>(Verve)</b></h3>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('user.list.card')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="credit-card"></i>
              <h3>Virtual Card <b>(Visa)</b></h3>
            </a>
          </li> 
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('user.transactions')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="bar-chart"></i>
              <h3>Transactions</h3>
            </a>
          </li>
           
          <li>
            <a href="<?php echo e(route('user.contact')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="mail"></i>
              <h3>Contact Us</h3>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('user.logout')); ?>" class="pages">
              <i class="sidebar-icon" data-feather="log-out"></i>
              <h3>Sign Out</h3>
            </a>
          </li>
        </ul>
        <div class="mode-switch">
          <ul class="switch-section"> 
            <li>
              <h3>Dark</h3>
              <div class="switch-btn">
                <input id="dark-switch" type="checkbox" />
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- side bar end -->

  <!-- header start -->
  <header class="section-t-space">
    <div class="custom-container">
      <div class="header-panel">
        <?php if(Route::current()->getName() != 'user.home'): ?>
        <a href="<?php echo e(route('user.home')); ?>" #onclick="history.back()" class="back-btn">
          <i class="icon" data-feather="arrow-left"></i>
        </a>
        <?php else: ?>
        <a class="sidebar-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
          <i class="menu-icon" data-feather="menu"></i>
        </a>
        <?php endif; ?>
        
        <img class="img-fluid logo" src="<?php echo e(url('/')); ?>/logo.png" style="  max-width: 10%;
        height: auto;" alt="logo" />
        <?php echo $__env->make('templates.basic.partials.userbreadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </header>
  <!-- header end -->
   <!-- header start -->
   <header class="section-t-space">
    <div class="custom-container">
      <div class="header-panel"> 
        <h2><?php echo e($pageTitle); ?></h2>
      </div>
    </div>
  </header>
  <!-- header end -->

    <?php echo $__env->yieldContent('panel'); ?>


      <!-- panel-space start -->
  <section class="panel-space"></section>
  <!-- panel-space end -->

  <!-- bottom navbar start -->

  <div class="navbar-menu">
    <div class="scanner-bg">
      <a href="<?php echo e(route('user.qr.index')); ?>" class="scanner-btn">
        <img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/scan.svg')); ?>" alt="scan" />
      </a>
    </div>
    <ul>
      <li class="">
        <a href="<?php echo e(route('user.withdraw')); ?>">
          <div class="icon">
            <img class="unactive" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/mpay.svg')); ?>" alt="mPay" />
            <img class="active" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/mpay-fill.svg')); ?>" alt="mPay" />
          </div>
          <h5 class="active">Payout</h5>
        </a>
      </li>
      <?php if($general->crypto > 0): ?>
      <li>
        <a href="<?php echo e(route('user.crypto.trade.index')); ?>">
          <div class="icon">
            <img class="unactive" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/bitcoin.svg')); ?>" alt="categories" />
            <img class="active" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/bitcoin-fill.svg')); ?>" alt="categories" />
          </div>
          <h5>Crypto</h5>
        </a>
      </li>
      <?php endif; ?>

      <li></li>

      <li>
        <a href="<?php echo e(route('user.tradegift')); ?>">
          <div class="icon">
            <i class="icon" data-feather="gift"></i>
          </div>
          <h5>Giftcard</h5>
        </a>
      </li>

      <li>
        <a href="<?php echo e(route('user.profile.setting')); ?>">
          <div class="icon">
            <img class="unactive" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/user.svg')); ?>" alt="profile" />
            <img class="active" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/user-fill.svg')); ?>" alt="profile" />
          </div>
          <h5>Profile</h5>
        </a>
      </li>
    </ul>
  </div>
  <!-- bottom navbar end -->

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
  <script src="<?php echo e(asset($activeTemplateTrue . 'mobile/js/select2.js')); ?>"></script>
  <script>
    $("#step2").hide()
  </script>
  <script>
    $(document).ready(function() { $("#banklist").select2(); });
  </script>
  
  <!-- Add the pull-to-refresh script here -->
    <script>
    let touchStartY = 0;
    let touchEndY = 0;
    let refreshThreshold = 150; // Increase this value to reduce sensitivity

    // Detect the start of the touch (finger placed on screen)
    window.addEventListener('touchstart', function(event) {
        if (window.scrollY === 0) { // Only trigger pull-to-refresh at the top of the page
            touchStartY = event.touches[0].clientY;
        }
    });

    // Detect the movement of the finger on screen
    window.addEventListener('touchmove', function(event) {
        if (window.scrollY === 0) { // Only check if the user is still at the top
            touchEndY = event.touches[0].clientY;
        }
    });

    // Detect when the user removes their finger from the screen
    window.addEventListener('touchend', function() {
        if (window.scrollY === 0 && touchEndY - touchStartY > refreshThreshold) {
            // Pull-to-refresh detected
            window.location.reload(); // Refresh the page
        }

        // Reset values
        touchStartY = 0;
        touchEndY = 0;
    });
</script>


    <?php echo $__env->yieldPushContent('script'); ?>
    <?php echo $__env->make('partials.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH C:\Users\DELL\PhpstormProjects\mobileltechng\resources\mobileapp/templates/basic/layouts/dashboard.blade.php ENDPATH**/ ?>