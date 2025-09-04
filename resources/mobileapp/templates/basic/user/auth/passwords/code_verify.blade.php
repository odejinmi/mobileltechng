@extends($activeTemplate . 'layouts.auth')
@section('content')
@php
$passwordContent = getContent('password.content', true);
@endphp
<!-- header starts -->
<div class="auth-header"style="background-color:#30003D;">
    <a href="{{url('/')}}"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img" src="{{ asset($activeTemplateTrue . 'mobile/images/authentication/2.svg')}}" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>OTP verification</h2>
        <h4 class="p-0">Enter 4 digit code</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
  <form class="auth-form" method="POST" action="{{ route('user.password.verify.code') }}">
    @csrf 
    <div class="custom-container">
      <div class="form-group">
        <h5>Enter the OTP we sent you in a registration message to confirm your email.</h5>
        <label for="inputusername" class="form-label">OTP</label>
        <div class="form-input">
            <input type="hidden" name="email" value="{{ $email }}"> 
          <input  type="text" name="code" maxlength="6"  class="form-control" id="inputusername" placeholder="Enter OTP" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100">Verify</button>

    </div>
  </form>
  <!-- login section start -->

 
@endsection

@push('style')
    
@endpush
