@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

    <!-- login section start -->
    <form action="" class="auth-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="custom-container">

            <div class="form-group">
                <div class="upload-image rounded-image">
                    <label for="formFileLg" class="form-label d-none">file </label>
                    <input class="form-control upload-file" onchange="readURL(this);" name="front" type="file"
                        id="formFileLg">
                    @if ($user->kyc_complete == 3 || $user->kyc_complete == 1)
                        <img id="khaytech" src="{{ asset('assets/images/kyc') }}/{{ $user->username }}/front_kyc_image.png" alt=""
                            class="img-fluid rounded-circle" width="120" height="120">
                    @else
                        <img id="khaytech" class="upload-icon dark-text" width="35"
                            src="https://static.vecteezy.com/system/resources/previews/015/337/675/original/transparent-upload-icon-free-png.png" />
                    @endif
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

            <h3 class="info-id">To confirm your information, upload front view of your ID.</h3>

            <div class="form-group">
                <div class="upload-image rounded-image">
                    <input class="form-control upload-file" onchange="readURL2(this);" type="file" name="back"
                        id="formFileLg">
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
    <!-- login section start -->

@endsection
