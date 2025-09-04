@extends('admin.layouts.master')
@section('content')
 <!--  Body Wrapper -->
 <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-4">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                  <img width="100" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="180" alt="">
                </a>
                 
                <div class="position-relative text-center my-4">
                     
                  <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">{{ __($pageTitle) }} @lang('to') {{ __($general->site_name) }}
                    @lang('Dashboard')</p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form class="" action="{{ route('admin.login') }}" method="POST">
                @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">@lang('Username')</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">@lang('Password')</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <x-captcha />
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        @lang('Remember Me')
                      </label>
                    </div>
                    <a class="text-primary fw-medium" href="{{ route('admin.password.reset') }}">@lang('Forgot Password') ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2 submits">@lang('SIGN IN')</a>
                    
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection
@push('script')
<script>
   

</script> 
@endpush