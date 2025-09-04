@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- pay money section starts -->
  <section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" style=""  onerror="this.onerror=null; this.src='{{ getImage(getFilePath('logoIcon') . '/default.png') }}'" src="{{ $qrCodeUrl }}" alt="p3" />
      </div>
      <h3 class="person-name"> @if (auth()->user()->ts)  @lang('Disabled Google 2FA') @else  @lang('Enable Google 2FA') @endif</h3>
      <h5 class="upi-id">
        @if (!auth()->user()->ts)
        <!--begin::Description-->
          @lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device') <a class="text--base"
          href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
          target="_blank">Download</a>
        @endif
      </h5>
      
      @if (auth()->user()->ts)
        <form class="form" action="{{ route('user.twofactor.disable') }}" method="POST">
        @else
        <form class="form" action="{{ route('user.twofactor.enable') }}" method="POST">
        @endif
        @csrf
        <div class="form-group mt-3">
          <div class="form-input" id="copyBoard">
            <input type="text" name="key"  value="{{ $secret }}" readonly class="form-control referralURL" id="copyBoard">
          </div>
        </div>

      <div class="form-group">
        <div class="form-input mt-3">
          <input type="text" class="form-control reason referralURL" name="code" placeholder="Enter authentication code" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100"> @if (auth()->user()->ts) Disabled @else Enable @endif</button>
    </div>
  </section>
  <!-- pay money section end -->


    
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                SlimNotifierJs.notification('success', 'Copied', '2FA Code Copied Successfuly', 3000);

                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
@push('breadcrumb-plugins')
    <a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
        <i class="icon" data-feather="x"></i>
    </a>
@endpush
