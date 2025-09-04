@extends($activeTemplate . 'layouts.dashboard')
@section('panel') 

    <!-- banner section starts -->
    <section>
        <div class="custom-container">
          <div class="swiper banner">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#">
                  <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/4747113.jpg')}}" alt="banner1" />
                </a>
              </div>
    
              <div class="swiper-slide">
                <a href="#">
                  <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/4747113.jpg')}}" alt="banner2" />
                </a>
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>
      <!-- banner section end -->


    <!-- Utility section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h4>Select Wallet</h4>
                <a href="#"></a>

            </div>
            <form class="auth-form p-0" method="post">
                <ul class="select-bank">
                    <li>
                        <div class="balance-box active">
                            <input class="form-check-input" type="radio" name="account_type" onchange="selectwallet('main')"
                                checked />
                            <img class="img-fluid balance-box-img active"
                                src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg') }}"
                                alt="balance-box" />
                            <img class="img-fluid balance-box-img unactive"
                                src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg') }}"
                                alt="balance-box" />
                            <div class="balance-content">
                                <h6> @lang('Main Wallet')</h6>
                                <h3>{{ $general->cur_sym }}{{ showAmount(Auth::user()->balance) }}</h3>
                                <h5>**** **** ****</h5>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="balance-box">
                            <input class="form-check-input" disabled type="radio" name="account_type"
                                onchange="selectwallet('ref')" />
                            <img class="img-fluid balance-box-img active"
                                src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg') }}"
                                alt="balance-box" />
                            <img class="img-fluid balance-box-img unactive"
                                src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg') }}"
                                alt="balance-box" />
                            <div class="balance-content">
                                <h6>@lang('Ref Wallet')</h6>
                                <h3>{{ $general->cur_sym }}{{ showAmount(Auth::user()->ref_balance) }}</h3>
                                <h5>**** **** ****</h5>
                            </div>
                        </div>
                    </li>
                </ul>
                @push('script')
                    <script>
                        function selectwallet(wallet) {
                            localStorage.setItem('wallet', wallet);
                        }
                    </script>
                @endpush


                <div class="form-group">
                    <label for="amount" class="form-label">@lang('Select Provider')</label>
                    <select name="company" id="disco" class="form-control" onchange="networkprovider()">
                        <option value="">@lang('Select Company')...</option>
                        @foreach ($networks as $data)
                            <option data-meter="{{ $data['name'] }}">{{ strToUpper($data['name']) }}</option>
                        @endforeach
                    </select>
                </div>
                @push('script')
                    <script>
                        function networkprovider() {
                            var company = $("#disco option:selected").attr('data-meter');
                            document.getElementById("company").value = company;
                        }
                        // END GET OPERATORS
                    </script>
                    <script>
                        function companymeter(network) {
                            document.getElementById("metertype").value = network;
                            document.getElementById("customer").innerHTML = '';
                            document.getElementById("customername").value = '';
                            document.getElementById("metertype2").innerHTML = network;
                        }
                    </script>
                @endpush

                <div class="form-group">
                    <div class="col-12 mb-1">
                        <div class="transaction-box">
                            <a href="#" class="d-flex gap-3">
                                <div class="transaction-image color1">
                                    <i class="iconsax categories-icon" data-feather="zap"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-name pb-0">
                                        <h5>Prepaid<br>
                                        </h5>
                                        <h5 class="dark-text fw-semibold">
                                            <div class="option d-block mt-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="1" onchange="companymeter('prepaid')" value="prepaid" />
                                                    <label class="form-check-label" for="1"></label>
                                                </div>
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <div class="transaction-box">
                            <a href="#" class="d-flex gap-3">
                                <div class="transaction-image color1">
                                    <i class="iconsax categories-icon" data-feather="archive"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-name pb-0">
                                        <h5>Pospaid<br>
                                        </h5>
                                        <h5 class="dark-text fw-semibold">
                                            <div class="option d-block mt-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="2" onchange="companymeter('postpaid')"
                                                        value="postpaid" />
                                                    <label class="form-check-label" for="2"></label>
                                                </div>
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label mb-1"><a id="serviceprovider"></a> @lang('meter number')</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input name="number" id="meternumber" onkeyup="verifymeter(this)" class="form-control" />

                </div>
                <div id="customer"></div>
                <center>
                    <div class="text-info" id="loader"></div>
                </center>
                <input id="customername" hidden>
                <input id="metertype" hidden>
                <input id="company"hidden>

                <div class="form-group">
                    <label class="form-label mb-1">@lang('Amount')</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input name="amount" id="amount" type="number" class="form-control" />
                </div>

                <div class="form-group">
                    <label class="form-label mb-1">@lang('Transaction PIN')</label>
                    <!--begin::Input-->
                    <input type="password" autocomplete="new-password" maxlength="6" onkeyup="verifypassword(this)"
                        id="password" class="form-control " name="password" placeholder="" />
                </div>
                <div id="passmessage"></div>
                @push('script')
                    <script>
                        function verifypassword(e) {
                            if (e.value.length < 6) {
                                return;
                            }
                            $("#passmessage").html(
                                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                            );

                            var raw = JSON.stringify({
                                _token: "{{ csrf_token() }}",
                                password: e.value,
                            });

                            var requestOptions = {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                body: raw
                            };
                            fetch("{{ route('user.trxpass') }}", requestOptions)
                                .then(response => response.text())
                                .then(result => {
                                    resp = JSON.parse(result);
                                    if (resp.ok != true) {
                                        document.getElementById("submit").disabled = true;
                                    }
                                    if (resp.ok != false) {
                                        document.getElementById("submit").disabled = false;
                                    }
                                    $("#passmessage").html(
                                        `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                                    );
                                })
                                .catch(error => {

                                });
                            // END GET DATA \\
                        }
                    </script>
                @endpush
                <button type="button" class="btn theme-btn w-100" onclick="submitform()" id="submit">Transfer</button>
            </form>
        </div>
    </section>

    <!-- successful transfer modal start -->

    <div class="modal successful-modal fade" id="done" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="doneheader"></h2>
                </div>
                <div class="modal-body">
                    <div class="done-img">
                        <div id="doneimage"></div>
                    </div>
                    <h2 id="sentamount"></h2>
                    <h3 id="sentmessage"></h3>
                </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <i class="icon" data-feather="x"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- successful transfer modal end -->
    <!-- Cabletv section end -->

    @push('script')
        <script>
            function verifymeter(pickup) {
                if (pickup.value.length > 9) {
                    // START GET CUSTOMER \\
                    $("#loader").html(
                        `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                    );
                    document.getElementById("customer").innerHTML = '';
                    var metertype = document.getElementById("metertype").value;
                    var company = document.getElementById("company").value;
                    var _token = $("input[name='_token']").val();
                    document.getElementById("customer").innerHTML = '';
                    $.ajax({
                        url: "{{ route('user.local.utility.verify') }}",
                        type: 'GET',
                        async: true,
                        data: {
                            _token: _token,
                            number: pickup.value,
                            metertype: metertype,
                            company: company
                        },
                        async: true,
                        cache: false,
                        dataType: "json",
                        success: function(data) {
                            document.getElementById("customer").innerHTML =
                                `
                            <label class="badge mb-1 bg-${data.status}"> 
                          <span>${data.content}</span>
                            </label>`;
                            document.getElementById("customername").value = data.content;
                            $("#loader").html('');
                        }
                    });
                    // END GET DATA \\ 

                }
            }
        </script>
        <script>
            // START BUY Power \\
            function submitform() {
                $("#passmessage").html(``);
                //document.getElementById("submit").disabled = true;
                var raw = JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    password: document.getElementById('password').value,
                    company: document.getElementById('company').value,
                    number: document.getElementById('meternumber').value,
                    customername: document.getElementById('customername').value,
                    metertype: document.getElementById('metertype').value,
                    amount: document.getElementById('amount').value,
                    wallet: localStorage.getItem('wallet'),
                });

                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                var company = document.getElementById('company').value;
                fetch("{{ route('user.buy.local.utility') }}", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        document.getElementById("sentamount").innerHTML = company;
                        document.getElementById("sentmessage").innerHTML = resp.message;
                        document.getElementById("doneheader").innerHTML = 'Transaction Successful';
                        document.getElementById("doneimage").innerHTML =
                            `<img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/done.svg') }}" alt="done" />`;
                        if (resp.status == 'danger') {
                            document.getElementById("doneheader").innerHTML = 'Transaction Failed';
                            document.getElementById("doneimage").innerHTML =
                                `<img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/error.svg') }}" alt="done" />`;
                        }
                        $('#done').modal('show');
                        $("#passmessage").html(``);
                        document.getElementById("submit").disabled = false;
                    })
                    .catch(error => {

                    });
            }
            // END BUY Power \\
        </script>
    @endpush

@endsection

@push('breadcrumb-plugins')
<a href="{{ route('user.utility.local.history') }}" class="back-btn">
    <i class="icon" data-feather="grid"></i>
  </a>
@endpush