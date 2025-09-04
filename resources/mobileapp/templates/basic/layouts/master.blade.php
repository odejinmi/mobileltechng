<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->siteName($pageTitle ?? '') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <link rel="shortcut icon" type="image/png" href="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}">
    <link  id="themeColors"  rel="stylesheet" href="{{ asset('assets/assets/dist/css/style-purple.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/prismjs/themes/prism-okaidia.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">
    <link href="{{ asset('assets/thirdparty/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
   {{-- <link href="{{ asset('assets/thirdparty/css/style.bundle.php')}}?color={{substr($general->base_color, 1)}}&secondColor={{substr($general->secondary_color, 1)}}" rel="stylesheet" type="text/css"/> --}}
    @stack('style-lib')
    @stack('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
        .float{
    	position:fixed;
    	width:60px;
    	height:60px;
    	bottom:40px;
    	right:40px;
    	background-color:#25d366;
    	color:#FFF;
    	border-radius:50px;
    	text-align:center;
      font-size:30px;
    	box-shadow: 2px 2px 3px #999;
      z-index:100;
    }
    
    .my-float{
    	margin-top:16px;
    }
    </style>
</head>

<body>
     <!-- Preloader -->
      <div class="preloader">
        <img src="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
      </div>
      <!-- Preloader -->
      <div class="preloader">
        <img src="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
      </div>
      <a href="https://api.whatsapp.com/send?phone=+2348031975397&text=I%20want%20to%20buy%20Smart%20Bills%20Solution." class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
        </a>
    @yield('content')
 
    @auth
    <div class="ps-footer-mobile">
        <div class="menu__content">
            <ul class="menu--footer">
                <li class="nav-item"><a class="nav-link" href="{{ route('user.buy.airtime') }}"><i class="ti ti-device-mobile"></i><span>@lang('Airtime')</span></a></li>
                <li class="nav-item"><a class="nav-link footer-category" href="{{ route('user.buy.internet') }}"><i class="ti ti-building-broadcast-tower"></i><span>@lang('Internet')</span></a></li>
                <li class="nav-item"><a class="nav-link footer-cart" href="{{route('user.buy.insurance')}}"><i class="ti ti-umbrella"></i><span class="badge bg-warning"></span><span>@lang('Insurance')</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.buy.cabletv') }}"><i class="ti ti-device-remote"></i><span>@lang('Cable TV')</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.buy.airtime') }}"><i class="ti ti-bulb"></i><span>@Lang('Utility')</span></a></li>
            </ul>
        </div>
    </div>
    @endauth

     <!--  Import Js Files -->
     <script src="{{ asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/libs/simplebar/dist/simplebar.min.j')}}s"></script>
     <script src="{{ asset('assets/assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
     <!--  core files -->
     <script src="{{ asset('assets/assets/dist/js/app.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/app.init.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/sidebarmenu.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/custom.js')}}"></script>

     <script src="{{ asset('assets/assets/dist/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/libs/apexcharts/dist/apexcharts.min.js')}}""></script>

     <script src="{{ asset('assets/assets/dist/libs/select2/dist/js/select2.full.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/libs/select2/dist/js/select2.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/forms/select2.init.js')}}"></script>

     <script src="{{ asset('assets/assets/dist/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/forms/bootstrap-switch.js')}}"></script>
     <script src="{{ asset('assets/thirdparty/js/nicEdit.js') }}"></script>
    <script src="{{ asset('assets/thirdparty/js/vendor/select2.min.js') }}"></script>

    <script src="{{ asset('assets/thirdparty/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/thirdparty/js/scripts.bundle.js')}}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


     <script>
        "use strict";
        bkLib.onDomLoaded(function() {
            $(".nicEdit").each(function(index) {
                $(this).attr("id", "nicEditor" + index);
                new nicEditor({
                    fullPanel: true
                }).panelInstance('nicEditor' + index, {
                    hasPanel: true
                });
            });
        });
        (function($) {
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });
        })(jQuery);
    </script>

    @include('partials.notify')
    @stack('script-lib')
    @stack('script')
    <script>
        (function ($) {
        "use strict";
        $('.submit').on('click', (e)=> {
        document.getElementsByClassName("submit")[0].disabled = true;
         });
        })(jQuery);
    </script>

</body>

</html>
