@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <!-- change password section start -->
    <section>
        <div class="custom-container"> 

            <form class="auth-form pt-0 mt-3" class="form" novalidate="novalidate" action="" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <div class="upload-image rounded-image">
                    <label for="formFileLg" class="form-label d-none">Avatar </label>
                    <input class="form-control upload-file" type="file" onchange="readURL(this);"   name="image" accept=".png, .jpg, .jpeg" id="formFileLg">
                      
                     <img id="khaytech" class="upload-icon dark-text" width="35"
                            src="https://static.vecteezy.com/system/resources/previews/015/337/675/original/transparent-upload-icon-free-png.png" />
                  </div>
                </div>
                
                @push('script')
                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.querySelector('#khaytech').setAttribute('src', e.target.result)
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    } 
                </script>
            @endpush


                <div class="form-group">
                    <label for="inputpin" class="form-label">First Name</label>
                    <input type="text" class="form-control mb-3 mb-lg-0"
                        placeholder="First name" name="firstname" value="{{ $user->firstname }}" />
                </div>

                <div class="form-group">
                    <label for="inputpin" class="form-label">Last Name</label>
                    <input type="text" class="form-control " placeholder="Last name"
                        name="lastname" value="{{ $user->lastname }}" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Gender</label>
                    <select name="gender" aria-label="Select a Gender" @if (@$user->gender != null) readonly @endif
                        data-control="select2" data-placeholder="Select a gender..."
                        class="form-select">
                        <option selected disabled>Select Gender</option>
                        <option @if (@$user->gender == 'Male') selected @endif value="Male">Male</option>
                        <option @if (@$user->gender == 'Female') selected @endif value="Male">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Date Of Birth</label>
                    <input type="text" placeholder="YYYY-MM-DD" class="form-control "
                        name="dob" value="{{ $user->dob }}" @if ($user->dob != null) readonlys @endif />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">City</label>
                    <input type="text" class="form-control " name="city"
                        value="{{ $user->address->city }}" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Zip Code</label>
                    <input type="text" class="form-control " name="zip"
                        value="{{ $user->address->zip }}" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Address</label>
                    <input type="text" class="form-control " name="address"
                        value="{{ $user->address->address }}" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">State</label>
                    <input type="text" class="form-control " name="state"
                        value="{{ $user->address->state }}" />
                </div>
                <div class="form-group">
                    <label for="inputpin" class="form-label">Country</label>
                    <select name="country" aria-label="Select a Country" data-control="select2"
                        data-placeholder="Select a country..." class="form-select">
                        @foreach ($countries as $key => $country)
                            <option @if (@$user->address->country == $country->country) selected @endif value="{{ $country->country }}"
                                data-code="{{ $key }}">
                                {{ __($country->country) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <ul class="notification-setting">
                    <li class="setting-title">
                      <div class="notification pt-0">
                        <h3 class="fw-semibold dark-text">Notification</h3>
                      </div>
                    </li>
            
                    <li>
                      <div class="notification">
                        <h5 class="fw-normal dark-text">Email Notification</h5>
                        <div class="switch-btn">
                          <input type="checkbox" @if ($user->en == 1) checked @endif type="checkbox"
                          name="en" value="1"  />
                        </div>
                      </div>
                    </li>
            
                    <li>
                      <div class="notification">
                        <h5 class="fw-normal dark-text">SMS Notification</h5>
                        <div class="switch-btn">
                          <input type="checkbox" @if ($user->sn == 1) checked @endif type="checkbox"
                          name="sn" value="1" />
                        </div>
                      </div>
                    </li> 
                  </ul>
                </div>


                <button type="submit" class="btn theme-btn w-100">Update Account</button>
            </form>
        </div>
    </section>
    <!-- change password section start --> 
@endsection

@push('breadcrumb-plugins')
    <a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
        <i class="icon" data-feather="x"></i>
    </a>
@endpush
