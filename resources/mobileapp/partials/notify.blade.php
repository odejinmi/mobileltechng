<script src="{{ asset('assets/global/js/slim_notifier.js') }}"></script>
@if (session()->has('notify'))
    @foreach (session('notify') as $msg)
        <script>
            "use strict";
            SlimNotifierJs.notification('{{ $msg[0] }}', '{{ __($msg[0]) }}', '{{ __($msg[1]) }}', 5000);
        </script>
    @endforeach
@endif
@if (session()->has('error'))
    <script>
        "use strict";
        SlimNotifierJs.notification('error', 'Oops', "{{ session('error') }}", 5000);
    </script>
@endif
@if (session()->has('success'))
    <script>
        "use strict";
        SlimNotifierJs.notification('success', 'Oops', "{{ session('success') }}", 5000);
    </script>
@endif
<script></script>
@if (isset($errors) && $errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        "use strict";
        @foreach ($errors as $error)
            SlimNotifierJs.notification('error', 'Oops', '{{ __($error) }}', 5000);
        @endforeach
    </script>
@endif
<script>
    "use strict";

    function notify(status, message) {
        SlimNotifierJs.notification([status], 'Hello', message, 5000);
    }
</script>

<script>
    $(document).ready(function() {
        $('#notfound').modal('show');
    } );
</script>
@if (session()->has('notfound'))
   <!-- error modal starts -->
   <div class="modal error-modal fade" id="404" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Not Available</h2>
            </div>
            <div class="modal-body">
                <div class="error-img">
                    <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/error.svg')}}" alt="error" />
                </div>
                <h3>{{ session('notfound') }}</h3>
            </div>
            <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                <i class="icon" data-feather="x"></i>
            </button>
        </div>
    </div>
</div>
@endif
<!-- error modal starts -->
<div class="modal error-modal fade" id="soon" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Coming Soon</h2>
            </div>
            <div class="modal-body">
                <div class="error-img">
                    <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/error.svg')}}" alt="error" />
                </div>
                <h3>This feature is not available at the moment</h3>
            </div>
            <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                <i class="icon" data-feather="x"></i>
            </button>
        </div>
    </div>
</div>
<!-- error modal starts -->
