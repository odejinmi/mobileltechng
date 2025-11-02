@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <!-- App View (initially hidden) -->
    <div id="appView" style="display: none;">
        <div class="verification-container" style="padding: 20px;">
            <div class="verification-header text-center mb-4">
                <h3 style="font-size: 24px; font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Identity Verification</h3>
                <p style="color: #7f8c8d; font-size: 14px;">Secure your account with additional verification</p>
            </div>

            <!-- BVN Verification -->
            <div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #e0e0e0;">
                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                    <div style="background: #e8f5e9; width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1Z" stroke="#388E3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 12C13.6569 12 15 10.6569 15 9C15 7.34315 13.6569 6 12 6C10.3431 6 9 7.34315 9 9C9 10.6569 10.3431 12 12 12Z" stroke="#388E3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15.5C14.5 15.5 16.5 16 16.5 17.5V19H7.5V17.5C7.5 16 9.5 15.5 12 15.5Z" stroke="#388E3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: #2c3e50;">BVN Verification</h4>
                        <p style="margin: 2px 0 0; font-size: 13px; color: #7f8c8d;">Verify with your Bank Verification Number</p>
                    </div>
                </div>
                <button onclick="startBVNVerification('{{ $user->email }}')" style="width: 100%; padding: 12px; background: #388E3C; color: white; border: none; border-radius: 8px; font-weight: 500; font-size: 15px; cursor: pointer; margin-top: 8px; transition: all 0.2s;">
                    Verify Now
                </button>
            </div>


            <!-- ID Card Verification -->
            <div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #e0e0e0;">
                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                    <div style="background: #e3f2fd; width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7 7H17M7 12H17M7 17H13" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: #2c3e50;">ID Card Verification</h4>
                        <p style="margin: 2px 0 0; font-size: 13px; color: #7f8c8d;">Verify with a valid ID card</p>
                    </div>
                </div>
                <button onclick="startIDVerification('{{ $user->email }}')" style="width: 100%; padding: 12px; background: #1976D2; color: white; border: none; border-radius: 8px; font-weight: 500; font-size: 15px; cursor: pointer; margin-top: 8px; transition: all 0.2s;">
                    Verify Now
                </button>
            </div>

            <!-- Security Info -->
            <div style="margin-top: 24px; padding: 16px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #1976D2;">
                <div style="display: flex;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px; flex-shrink: 0; margin-top: 2px;">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 16V12" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 8H12.01" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p style="margin: 0; font-size: 13px; color: #555; line-height: 1.5;">
                        Your information is encrypted and securely stored. We use bank-level security to protect your data.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Browser View (initially shown) -->
    <div id="browserView">
        <form action="" class="auth-form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="custom-container">
                <div class="form-group">
                    <div class="upload-image rounded-image">
                        <label for="formFileLg" class="form-label d-none">file </label>
                        <input class="form-control upload-file" onchange="readURL(this);" name="front" type="file" id="formFileLg">
                        @if ($user->kyc_complete == 3 || $user->kyc_complete == 1)
                            <img id="khaytech" src="{{ asset('assets/images/kyc') }}/{{ $user->username }}/front_kyc_image.png" alt=""
                                class="img-fluid rounded-circle" width="120" height="120">
                        @else
                            <img id="khaytech" class="upload-icon dark-text" width="35"
                                src="https://static.vecteezy.com/system/resources/previews/015/337/675/original/transparent-upload-icon-free-png.png" />
                        @endif
                    </div>
                </div>

                <h3 class="info-id">To confirm your information, upload front view of your ID.</h3>

                <div class="form-group">
                    <div class="upload-image rounded-image">
                        <input class="form-control upload-file" onchange="readURL2(this);" type="file" name="back" id="formFileLg2">
                        @if ($user->kyc_complete == 3 || $user->kyc_complete == 1)
                            <img id="khaytech2" src="{{ asset('assets/images/kyc') }}/{{ $user->username }}/back_kyc_image.png" alt=""
                                class="img-fluid rounded-circle" width="120" height="120">
                        @else
                            <img id="khaytech2" class="upload-icon dark-text" width="35"
                                src="https://static.vecteezy.com/system/resources/previews/015/337/675/original/transparent-upload-icon-free-png.png" />
                        @endif
                    </div>
                </div>
                <h3 class="info-id border-0 pb-0">To confirm your information, upload back view of your ID.</h3>

                <div class="form-group">
                    @if ($user->kyc_complete == 3 || $user->kyc_complete == 1)
                        <div class="text-center">
                            <p class="mb-0">{{ @$user->kyc->type }}</p>
                            @if ($user->kyc_complete == 3)
                                <badge class="badge bg-warning">@lang('Pending')</badge>
                            @elseif($user->kyc_complete == 1)
                                <badge class="badge bg-success">@lang('Approved')</badge>
                            @endif
                        </div>
                    @else
                        <label for="exampleInputPassword1" class="form-label fw-semibold">@lang('Document Type')</label>
                        <select name="type" class="select2 form-control form-control-lg" style="width: 100%; height: 36px">
                            <option>Select</option>
                            <option>Voters Card</option>
                            <option>Drivers Licence</option>
                            <option>Work ID Card</option>
                            <option>International Passport</option>
                            <option>Drivers Licence</option>
                            <option>Passport Photograph</option>
                            <option>Address Utility Bill</option>
                            <option>NIN Card</option>
                        </select>
                    @endif
                </div>

                @if ($user->kyc_complete == 0 || $user->kyc_complete == 2)
                    <button type="submit" class="btn theme-btn w-100">Upload Document</button>
                @endif
            </div>
        </form>
    </div>


    @push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded');
            console.log(typeof web2app !== 'undefined' && web2app.isNative());
            if (typeof web2app !== 'undefined' && web2app.isNative()) {
                // Show app view and hide browser view
                document.getElementById('appView').style.display = 'block';
                document.getElementById('browserView').style.display = 'none';
            } else {
                // Show browser view and hide app view
                document.getElementById('appView').style.display = 'none';
                document.getElementById('browserView').style.display = 'block';
            }
        });

        function startIDVerification(email) {
            // Add your ID verification logic here
            if (typeof web2app !== 'undefined' && web2app.isNative()) {
                web2app.startIDVerification();
            } else {
                alert('Please use the mobile app to complete ID verification');
            }
        }

        function web2appInit(data) {
            console.log("web2app is ready")
            console.log(JSON.stringify(data));
        }

        function startBVNVerification(email) {
            // Add your BVN verification logic here
            console.log(email);
            if (typeof web2app !== 'undefined' && web2app.isNative()) {
                web2app.bvnverification({'identifier':email, 'type':'bvn'}, function(response){
                    console.log(response);
                });
            } else {
                alert('Please use the mobile app to complete BVN verification');
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#khaytech').setAttribute('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#khaytech2').setAttribute('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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

        function readURL2(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#khaytech2').setAttribute('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
@endsection
