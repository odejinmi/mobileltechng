@extends($activeTemplate . 'layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include($activeTemplate . 'partials.sidenav')
        @include($activeTemplate . 'partials.topnav') 
        @yield('panel')
    </div>
@endsection 