<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="mpay" />
    <meta name="keywords" content="mpay" />
    <meta name="author" content="mpay" />
    <link rel="manifest" href="{{ asset($activeTemplateTrue . 'mobile/manifest.json') }}" />
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
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'mobile/css/vendors/iconsax.css')}}" />

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="{{ asset($activeTemplateTrue . 'mobile/css/vendors/bootstrap.min.css') }}" />

    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'mobile/css/vendors/swiper-bundle.min.css') }}" />

    <!-- Theme css -->
        <link rel="stylesheet" id="change-link" type="text/css" href="{{ asset($activeTemplateTrue . 'mobile/css/style.css') }}" />
        <link rel="stylesheet" id="change-link" type="text/css" href="{{ asset($activeTemplateTrue . 'mobile/css/select2.css') }}" />
    {{-- <link rel="stylesheet" id="change-link" type="text/css" href="{{ asset($activeTemplateTrue . 'mobile/css/style.php') }}?color={{substr($general->base_color, 1)}}&secondColor={{substr($general->secondary_color, 1)}}" />--}}
    @stack('style')

</head>

<body class="">
<!-- side bar start -->
<div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
    <div class="offcanvas-header sidebar-header">
      <div class="sidebar-logo">
        <img class="img-fluid losgo" src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}"  width="30" alt="logo" />
      </div>
      <div class="balance img-fluid balance-bg" style="background-color:#30003D;">
        <div class="img-fluid balance-bg" alt="auth-bg" /></div>
        <h5></h5>
        <h2>{{ $general->cur_sym }}{{ showAmount(Auth::user()->balance) }}</h2>
      </div>
    </div>
    <div class="offcanvas-body">
      <div class="sidebar-content">
        <ul class="link-section">
          @php
    $currentHour = now()->hour;
    $isDisabled = ($currentHour >= 22 || $currentHour < 6);
    $disabledClass = $isDisabled ? 'disabled-link' : '';
    $tooltip = $isDisabled ? 'data-bs-toggle="tooltip" data-bs-placement="right" title="Verification is only available from 6 AM to 10 PM"' : '';
@endphp

<li>
    @if($isDisabled)
        <a href="javascript:void(0)" class="pages {{ $disabledClass }}" {!! $tooltip !!}>
            <i class="sidebar-icon" data-feather="shield"></i>
            <h3>Verification</h3>
            <span class="badge bg-warning">Closed</span>
        </a>
    @else
        <a href="{{ route('user.kyc.index') }}" class="pages">
            <i class="sidebar-icon" data-feather="shield"></i>
            <h3>Verification</h3>
        </a>
    @endif
</li>

@push('style')
<style>
    .disabled-link {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
        text-decoration: none;
    }
    .disabled-link h3 {
        color: #6c757d;
    }
</style>
@endpush

@push('script')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
          @if ($general->buy_giftcard > 0 || $general->sell_giftcard > 0)
          <li>
            <a href="{{ route('user.tradegift') }}" class="pages">
              <i class="sidebar-icon" data-feather="gift"></i>
              <h3>Giftcard</h3>
            </a>
          </li>
          @endif
          @if($general->loan > 0)
          <li>
            <a href="{{ route('user.loan.plans') }}" class="pages">
              <i class="sidebar-icon" data-feather="percent"></i>
              <h3>Loans</h3>
            </a>
          </li>
          @endif
          @if($general->savings)
          <li>
            <a href="{{ route('user.savings.start.new') }}" class="pages">
              <i class="sidebar-icon" data-feather="shopping-bag"></i>
              <h3>Savings</h3>
            </a>
          </li>
          @endif
          @if($general->virtualcard)
          <li>
            <a href="{{ route('user.virtualcard.index') }}" class="pages">
              <i class="sidebar-icon" data-feather="credit-card"></i>
              <h3>Virtual Card <b>(Verve)</b></h3>
            </a>
          </li>
          <li>
            <a href="{{ route('user.list.card')  }}" class="pages">
              <i class="sidebar-icon" data-feather="credit-card"></i>
              <h3>Virtual Card <b>(Visa)</b></h3>
            </a>
          </li>
          @endif
          <li>
            <a href="{{route('user.transactions')}}" class="pages">
              <i class="sidebar-icon" data-feather="bar-chart"></i>
              <h3>Transactions</h3>
            </a>
          </li>

          <li>
            <a href="{{route('user.contact')}}" class="pages">
              <i class="sidebar-icon" data-feather="mail"></i>
              <h3>Contact Us</h3>
            </a>
          </li>
          <li>
            <a href="{{route('user.logout')}}" class="pages">
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
        @if(Route::current()->getName() != 'user.home')
        <a href="{{route('user.home')}}" #onclick="history.back()" class="back-btn">
          <i class="icon" data-feather="arrow-left"></i>
        </a>
        @else
        <a class="sidebar-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
          <i class="menu-icon" data-feather="menu"></i>
        </a>
        @endif

        <img class="img-fluid logo" src="{{url('/')}}/logo.png" style="  max-width: 10%;
        height: auto;" alt="logo" />
        @include('templates.basic.partials.userbreadcrumb')
      </div>
    </div>
  </header>
  <!-- header end -->
   <!-- header start -->
   <header class="section-t-space">
    <div class="custom-container">
      <div class="header-panel">
        <h2>{{$pageTitle}}</h2>
      </div>
    </div>
  </header>
  <!-- header end -->

    @yield('panel')


      <!-- panel-space start -->
  <section class="panel-space"></section>
  <!-- panel-space end -->

  <!-- bottom navbar start -->

  <div class="navbar-menu">
    <div class="scanner-bg">
      <a href="{{ route('user.qr.index') }}" class="scanner-btn">
        <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/scan.svg')}}" alt="scan" />
      </a>
    </div>
    <ul>
      <li class="">
        <a href="{{ route('user.withdraw') }}">
          <div class="icon">
            <img class="unactive" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/mpay.svg')}}" alt="mPay" />
            <img class="active" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/mpay-fill.svg')}}" alt="mPay" />
          </div>
          <h5 class="active">Payout</h5>
        </a>
      </li>
      @if ($general->crypto > 0)
      <li>
        <a href="{{ route('user.crypto.trade.index') }}">
          <div class="icon">
            <img class="unactive" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/bitcoin.svg')}}" alt="categories" />
            <img class="active" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/bitcoin-fill.svg')}}" alt="categories" />
          </div>
          <h5>Crypto</h5>
        </a>
      </li>
      @endif

      <li></li>

      <li>
        <a href="{{ route('user.tradegift') }}">
          <div class="icon">
            <i class="icon" data-feather="gift"></i>
          </div>
          <h5>Giftcard</h5>
        </a>
      </li>

      <li>
        <a href="{{ route('user.profile.setting') }}">
          <div class="icon">
            <img class="unactive" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/user.svg')}}" alt="profile" />
            <img class="active" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/user-fill.svg')}}" alt="profile" />
          </div>
          <h5>Profile</h5>
        </a>
      </li>
    </ul>
  </div>
  <!-- bottom navbar end -->

  <script src="{{ asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')}}"></script>

  <script src="{{ asset($activeTemplateTrue . 'mobile/js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/custom-swiper.js') }}"></script>

  <!-- feather js -->
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/feather.min.js') }}"></script>
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/custom-feather.js') }}"></script>

  <!-- iconsax js -->
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/iconsax.js') }}"></script>

  <!-- bootstrap js -->
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/bootstrap.bundle.min.js') }}"></script>

  <!-- homescreen popup js -->
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/homescreen-popup.js') }}"></script>

  <!-- PWA offcanvas popup js -->
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/offcanvas-popup.js') }}"></script>

  <!-- script js -->
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/script.js') }}"></script>
  <script src="{{ asset($activeTemplateTrue . 'mobile/js/select2.js') }}"></script>
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


    @stack('script')
    @include('partials.plugins')
    @include('partials.notify')

</body>
</html>
