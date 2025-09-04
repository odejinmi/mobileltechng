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
                    @lang('Enter your new password below to reset your password')               
                  </p>
                </div>
                <form class="space-y-5" action="{{ route('admin.password.change') }}" method="POST" class="login-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                      <label for="email" class="form-label">@lang('New Password')</label>
                      <input id="password" name="password" type="password" class="form-control" placeholder="Enter New Password" />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">@lang('Confirm Password')</label>
                      <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" />
                    </div>
                  <button type="subit" class="btn btn-primary w-100 py-8 mb-3">@lang('Reset Password')</button>
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
