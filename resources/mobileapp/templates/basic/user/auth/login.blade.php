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
                <button type="button" onclick="googlesignin()" class="btn btn-danger">
                    <svg width="18" height="18" viewBox="0 0 24 24" class="me-2">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continue with Google
                </button>
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


        function web2appInit(data) {
            console.log("web2app is ready")
            console.log(JSON.stringify(data));
        }

        function googlesignin() {
            // Add your BVN verification logic here
            if (typeof web2app !== 'undefined' && web2app.isNative()) {
                // Uncomment this in production

                web2app.googlesignin.signin( function(response) {
                    console.log('BVN Verification Response:', JSON.stringify(response));
                    console.log('BVN Verification Response:', JSON.stringify(response.success));

                    // Handle the response structure
                    // if (response && response.message) {
                    //     const responseData = response.message;
                    console.log('Response Data:', JSON.stringify(response));
                    console.log('Response Data:', JSON.stringify(response.data));
                    // } else {
                    //     console.error('Invalid response format:', response);
                    // }
                    if (response && response.success){
                        updatedata(response)
                    }
                });

            } else {
                window.location.href = "{{ route('user.google.login') }}";
            }
        }


        function normalizeName(name) {
            if (!name) return '';
            return name
                .toLowerCase()
                .trim()
                .replace(/\s+/g, ' ')  // Replace multiple spaces with single space
                .replace(/[^a-z\s]/g, '') // Remove special characters
                .split(' ')             // Split into array of name parts
                .filter(part => part.length > 1) // Remove single letters
                .sort()                 // Sort alphabetically
                .join(' ')              // Join back to string
                .trim();
        }

        function compareNames(name1, name2) {
            if (!name1 || !name2) return false;

            const normalized1 = normalizeName(name1);
            const normalized2 = normalizeName(name2);

            // Check for exact match
            if (normalized1 === normalized2) return true;

            // Check if one name is contained within the other
            if (normalized1.includes(normalized2) || normalized2.includes(normalized1)) {
                return true;
            }

            // Check for at least 60% match using Levenshtein distance
            const similarity = 1 - levenshteinDistance(normalized1, normalized2) /
                Math.max(normalized1.length, normalized2.length);

            return similarity >= 0.6; // 60% match threshold
        }

        // Levenshtein distance implementation
        function levenshteinDistance(a, b) {
            const matrix = [];
            for (let i = 0; i <= b.length; i++) {
                matrix[i] = [i];
            }
            for (let j = 0; j <= a.length; j++) {
                matrix[0][j] = j;
            }
            for (let i = 1; i <= b.length; i++) {
                for (let j = 1; j <= a.length; j++) {
                    if (b.charAt(i-1) === a.charAt(j-1)) {
                        matrix[i][j] = matrix[i-1][j-1];
                    } else {
                        matrix[i][j] = Math.min(
                            matrix[i-1][j-1] + 1,
                            matrix[i][j-1] + 1,
                            matrix[i-1][j] + 1
                        );
                    }
                }
            }
            return matrix[b.length][a.length];
        }

        function updatedata(response) {
            // Show loading overlay
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.style.display = 'flex';

            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                name: response.displayName,
                email: response.email,
                id: response.id,
                avatar: response.photoUrl,
            });

            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: raw
            };

            fetch("{{ route('user.app.google.callback') }}", requestOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(result => {
                    // Show success message
                    const message = result.message || 'Verification successful';
                    const status = result.status || 'success';

                    // Update UI with response
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `alert alert-${status}`;
                    messageDiv.role = 'alert';
                    messageDiv.innerHTML = `<strong>${status.charAt(0).toUpperCase() + status.slice(1)} - </strong> ${message}`;

                    const container = document.getElementById('passmessage') || document.body;
                    container.innerHTML = '';
                    container.appendChild(messageDiv);

                    // If verification was successful, reload the page after a delay
                    if (status === 'success') {
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'alert alert-danger';
                    errorDiv.role = 'alert';
                    errorDiv.textContent = 'An error occurred during verification. Please try again.';

                    // Safely handle the message container
                    const container = document.getElementById('passmessage');
                    if (container) {
                        container.innerHTML = '';
                        container.appendChild(errorDiv);
                    } else {
                        // If passmessage doesn't exist, create it
                        const newContainer = document.createElement('div');
                        newContainer.id = 'passmessage';
                        newContainer.appendChild(errorDiv);
                        document.body.prepend(newContainer);
                    }
                })
                .finally(() => {
                    // Hide loading overlay
                    loadingOverlay.style.display = 'none';
                });
        }

        function loadbutton() {
            $("#loader").html(
                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
            );
            document.getElementById("button").disabled = true;
            document.getElementById("login").submit();

        }
    </script>
@endpush
