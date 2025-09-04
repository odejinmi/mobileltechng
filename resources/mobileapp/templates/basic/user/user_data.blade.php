@extends($activeTemplate . 'layouts.frontend')
@section('content')

<!-- header starts -->
<div class="auth-header">
    <a href="#"> <i class="back-btn" data-feather="arrow-left"></i> </a>

    <img class="img-fluid img" src="{{ asset($activeTemplateTrue . 'mobile/images/authentication/1.svg')}}" alt="v1" />

    <div class="auth-content">
      <div>
        <h2>Personal identity</h2>
        <h4 class="p-0">Fill up the form</h4>
      </div>
    </div>
  </div>
  <!-- header end -->

  <!-- login section start -->
    <form method="POST" class="auth-form" action="{{ route('user.data.submit') }}" enctype="multipart/form-data">
        @csrf 
    <div class="custom-container">
      <div class="form-group">
        <label for="inputusername" class="form-label">@lang('First Name')</label>
        <div class="form-input">
            <input type="text" class="form-control form-control-solid" name="firstname" value="{{ old('firstname') }}" placeholder="@lang('Enter First Name')" required />
        </div>
      </div>

      <div class="form-group">
        <label for="inputpin" class="form-label">@lang('Last Name')</label>
        <div class="form-input">
            <input type="text" class="form-control form-control-solid" name="lastname" value="{{ old('lastname') }}" placeholder="@lang('Enter Last Name')" required />
        </div>
      </div>
      <div class="form-group">
        <label for="inputday" class="form-label">@lang('Address')</label>
        <div class="form-input">
        <input type="text" class="form-control form-control-solid"  name="address" value="{{ old('address') }}"placeholder="@lang('Enter Your Address')" />
        </div>
      </div>
      <div class="form-group">
        <label for="inputgender" class="form-label">@lang('State') </label>
        <input type="test" class="form-control form-control-solid" name="state" value="{{ old('state') }}"placeholder="@lang('Enter Your State')" />
      </div>
      <div class="form-group">
        <div class="upload-image">
            <input class="form-control upload-file" type="file" name="image" accept=".png, .jpg, .jpeg" id="formFileLg">
            <h5 class="dark-text position-absolute fs-6">Upload your photo</h5>
        </div>
       </div>

      <button type="submit" class="btn theme-btn w-100">Continue</button>
      <a href="{{route('user.logout')}}" class="btn btn-link mt-3">Logout</a>
    </div>
  </form>
  <!-- login section start -->
  
@endsection
