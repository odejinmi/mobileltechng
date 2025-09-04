@extends('admin.layouts.master')
@section('content')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
          <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
              <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                  <div class="card-body pt-5">
                    <a href="#" class="text-nowrap logo-img text-center d-block mb-4">
                        <img width="100" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="180" alt="">
                    </a>
                    <div class="mb-5 text-center">
                      <p class="mb-0 ">   
                        @lang('Please enter the email address associated with your account and We will email you a link to reset your password').                
                      </p>
                    </div>
                    <form action="{{ route('admin.password.reset') }}" method="POST" class="login-form">
                    @csrf
                      <div class="mb-3">
                        <label for="email" class="form-label">@lang('Email address')</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                      </div>
                      <button type="subit" class="btn btn-primary w-100 py-8 mb-3">@lang('Forgot Password')</button>
                      <a href="{{ route('admin.login') }}" class="btn btn-light-primary text-primary w-100 py-8">@lang('Back to Login')</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
       
 
@endsection
