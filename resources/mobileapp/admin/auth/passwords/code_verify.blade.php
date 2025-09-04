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
                <a href="#" class="text-nowrap w-100 logo-img text-center d-block mb-4">
                    <img width="100" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="180" alt="">
                </a>
                <div class="mb-5 text-center">
                  <p>@lang('Please check your email and enter the verification code you got in your email.')</p>
                  <h6 class="fw-bolder"></h6>
                </div>
                <form class="space-y-5" action="{{ route('admin.password.verify.code') }}" method="POST" class="login-form">
                @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-semibold">@lang('Type your 6 digits security code')</label>
                    <div class="d-flex align-items-center gap-2 gap-sm-3">
                      <input type="text" name="r1" class="form-control" placeholder="">
                      <input type="text" name="r2" class="form-control" placeholder="">
                      <input type="text" name="r3"  class="form-control" placeholder="">
                      <input type="text" name="r4"  class="form-control" placeholder="">
                      <input type="text" name="r5"  class="form-control" placeholder="">
                      <input type="text" name="r6"  class="form-control" placeholder="">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4">@lang('Verify My Account')</button>
                  <div class="d-flex align-items-center">
                    <p class="fs-4 mb-0 text-dark">@lang('Didn\'t get the code')?</p>
                    <a class="text-primary fw-medium ms-2" href="{{ route('admin.password.reset') }}">@lang('Resend')</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

     
@endsection

@push('style')
 @endpush

@push('script')
    
@endpush
