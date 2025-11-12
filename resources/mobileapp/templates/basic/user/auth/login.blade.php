@extends($activeTemplate . 'layouts.auth')

@section('content')
    @php
        $loginContent = getContent('login.content', true);
    @endphp
    <!-- header starts -->
    <div class="auth-header" style="background-color:#30003D;">
        <a href="{{ url('/') }}"> <i class="back-btn" data-feather="arrow-left"></i> </a>

        <img class="img-fluid img" src="{{ asset($activeTemplateTrue . 'mobile/images/authentication/1.svg') }}"
            alt="v1" />

        <div class="auth-content">
            <div>
                <h2>Welcome back !!</h2>
                <h4 class="p-0">Fill up the form</h4>
            </div>
        </div>
    </div>
    <!-- header end -->

    <!-- login section start -->
    <form class="auth-form" method="POST" id="login" action="{{ route('user.login') }}">
        @csrf
        <div class="custom-container">
            <div class="form-group">
                <label for="inputusername" class="form-label">Username</label>
                <div class="form-input">
                    <input type="text" class="form-control" id="inputusername" name="username"
                        placeholder="Enter Your Username" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputpin" class="form-label">Password</label>
                <div class="form-input">
                    <input type="password" name="password" class="form-control" id="inputpin"
                        placeholder="Enter Your Password" />
                </div>
            </div>
            <div class="remember-option mt-3">
                <a class="forgot" href="{{ route('user.password.request') }}">Forgot Password?</a>
            </div>

            <button type="button" id="button" style="background-color:#30003D;" class="btn theme-btn w-100" onclick="loadbutton()">Sign In</button>
            <div id="loader"></div>

            <div>   </div>
            <!-- Google Login Button -->
            <div class="d-grid">
                <a href="{{ route('user.google.login') }}" class="btn btn-danger">
                    <svg width="18" height="18" viewBox="0 0 24 24" class="me-2">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continue with Google
                </a>
            </div>

            <div class="division">
                <span>OR</span>
            </div>

            <a href="{{ route('user.register') }}" target="" class="btn gray-btn mt-3"> Signup Account</a>

        </div>
    </form>
    <!-- login section start -->
@endsection
@push('script')
    <script>
        function loadbutton() {
            $("#loader").html(
                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
            );
            document.getElementById("button").disabled = true;
            document.getElementById("login").submit();

        }
    </script>
@endpush
