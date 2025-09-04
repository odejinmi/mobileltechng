<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->siteName($pageTitle ?? '') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}">
    <link  id="themeColors"  rel="stylesheet" href="{{ asset('assets/assets/dist/css/style.min.css')}}" />
    <link href="{{ asset($activeTemplateTrue . 'css/css.php') }}?color={{substr($general->base_color, 1)}}&secondColor={{substr($general->secondary_color, 1)}}" rel="stylesheet">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/prismjs/themes/prism-okaidia.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/select2/dist/css/select2.min.css')}}">            
    <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @stack('style-lib') 
    @stack('style') 
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
 
    @yield('content')

     <!--  Import Js Files -->
     <script src="{{ asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/libs/simplebar/dist/simplebar.min.j')}}s"></script>
     <script src="{{ asset('assets/assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
     <!--  core files -->
     <script src="{{ asset('assets/assets/dist/js/app.min.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/app.init.js')}}"></script>
     <script src="{{ asset('assets/assets/dist/js/app-style-switcher.js')}}"></script>
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
     <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
    <script src="{{ asset('assets/thirdparty/js/vendor/select2.min.js') }}"></script>
     <script>
        "use strict";
        function showAmount(number) {
            var str = number.toString().split(".");
            str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return str.join(".");
        }

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

</body>

</html>
