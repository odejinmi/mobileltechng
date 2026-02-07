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

    <!-- Cabletv section starts -->
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
                            <input class="form-check-input" type="radio"  name="account_type" onchange="selectwallet('main')"
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
                            <input class="form-check-input" type="radio" disabled name="account_type"
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
                    <li>
                        <div class="balance-box">
                            <input class="form-check-input" type="radio" name="account_type"
                                   onchange="selectwallet('bonus')" />
                            <img class="img-fluid balance-box-img active"
                                 src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg') }}"
                                 alt="balance-box" />
                            <img class="img-fluid balance-box-img unactive"
                                 src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg') }}"
                                 alt="balance-box" />
                            <div class="balance-content">
                                <h6>@lang('Bonus')</h6>
                                <h3>{{ $general->cur_sym }}{{ showAmount(Auth::user()->bonus_balance) }}</h3>
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
                    <label for="amount" class="form-label">@lang('Select Decoder')</label>
                    <select name="country" class="form-select form-select-solid" data-control="select2" id="youSendCurrency"
                        data-hide-search="false" onchange="populate()" data-placeholder="@lang('Select Decoder')">
                        <option value="">@lang('Select Decoder')...</option>
                        @foreach ($networks as $data)
                            <option data-decoder="{{ $data['name'] }}">
                                {{ strToUpper($data['name']) }}</option>
                        @endforeach
                    </select>
                </div>
                @push('script')
                    <script>
                        function populate() {
                            // START GET DATA \\
                            // Show page loading
                            $("#passmessage").html(
                                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                                );
                            document.getElementById('providers').innerHTML = '';
                            var decoder = $("#youSendCurrency option:selected").attr('data-decoder');
                            document.getElementById("decodertype").value = decoder;
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: "{{ route('user.cabletv.operators') }}",
                                type: 'GET',
                                async: true,
                                data: {
                                    _token: _token,
                                    decoder: decoder
                                },
                                cache: false,
                                dataType: "json",
                                success: function(data) {
                                    if (data.status == 'true') {
                                        var plans = data.content;
                                        var image = data.image;
                                        console.info(plans);
                                        let html = '';
                                        plans.map(plan => {

                                            let htmlSegment =
                                                `
                                                                    <div class="col-12 mb-1">
                                                                        <div class="transaction-box">
                                                                            <a href="#" class="d-flex gap-3">
                                                                            <div class="transaction-image color1">
                                                                                <img class="img-fluid icons" src="${image}" width="30" alt="bitcoins" />
                                                                            </div>
                                                                            <div class="transaction-details">
                                                                                <div class="transaction-name pb-0">
                                                                                <h5>${plan['name']}<br>
                                                                                <small>  {{ $general->cur_sym }}${plan['variation_amount']}</small>
                                                                                </h5>
                                                                                <h5 class="dark-text fw-semibold">
                                                                                    <div class="option d-block mt-3">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="radio" name="plan" onchange="networkprovider('${plan['variation_code']}|${plan['variation_amount']}')" value="${plan['variation_code']}|${plan['variation_amount']}" id="flexradio${plan['variation_code']}" />
                                                                                            <label class="form-check-label" for="flexradio${plan['variation_code']}"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </h5>
                                                                                </div>
                                                                            </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    `;
                                            html += htmlSegment;
                                        });

                                        document.getElementById('providers').innerHTML =
                                            ` ${html}
                                                                    `;

                                        //  $("#loadered").html('');
                                    } else {
                                        // $("#loadered").html('');
                                    }
                                    document.getElementById('passmessage').innerHTML = '';


                                }
                            });
                            // END GET DATA \\
                        }
                    </script>

                    <script>
                        function networkprovider(operatorId) {
                            document.getElementById("plan").value = operatorId;

                        }
                        // END GET OPERATORS
                    </script>
                @endpush
                <input id="plan" hidden>
                <input id="decodertype" hidden>

                <div class="form-group">
                    <div id="providers"></div>
                </div>

                <div class="form-group">
                    <label class="form-label mb-3"> <a id="serviceprovider"></a> @lang('Decoder Number')</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input name="decoder" id="decoder" onkeyup="verifydecoder(this)"
                        class="form-control form-control-lg form-control-solid" />
                </div>
                <center>
                    <div class="text-info" id="loader"></div>
                </center>
                <center>
                    <div class="" id="customer"></div>
                </center>
                <input id="customername" name="customer" hidden>



                <div class="form-group">
                    <label class="form-label mb-3">@lang('Transaction PIN')</label>
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
@endsection

@push('script')
    <script>
        function verifydecoder(pickup) {
            if (pickup.value.length > 9) {
                // START GET DATA \\
                $("#loader").html(
                    `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                    );

                document.getElementById("customer").innerHTML = '';
                var decoder = document.getElementById("decodertype").value;
                var _token = $("input[name='_token']").val();
                document.getElementById("customer").innerHTML = '';
                $.ajax({
                    url: "{{ route('user.cabletv.verifydecoder') }}",
                    type: 'GET',
                    async: true,
                    data: {
                        _token: _token,
                        number: pickup.value,
                        decoder: decoder
                    },
                    async: true,
                    cache: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.ok = true) {
                            document.getElementById("customer").innerHTML = `
                 <label class="badge mb-1 bg-${data.status}">
                          <span>Customer Name: ${data.content}</span>
                      </label>
                `;
                            document.getElementById("customername").value = data.content;
                            $("#loader").html('');
                        } else {
                            $("#loader").html('');
                            document.getElementById("customer").innerHTML = `
                            <label class="badge mb-1 bg-${data.status}">
                                    <span>${data.content}</span>
                                </label>
                            `;
                        }

                    }
                });
                // END GET DATA \\

            }
        }
    </script>
    <script>
        // START BUY Cable TV \\
        function submitform() {
            $("#passmessage").html(
                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                );

            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                password: document.getElementById('password').value,
                number: document.getElementById('decoder').value,
                customername: document.getElementById('customername').value,
                plan: document.getElementById('plan').value,
                decoder: document.getElementById('decodertype').value,
                wallet: localStorage.getItem('wallet'),
            });
            var decoder = document.getElementById('decodertype').value;
            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("{{ route('user.buy.cabletv') }}", requestOptions)
                .then(response => response.text())
                .then(result => {
                    resp = JSON.parse(result);
                    document.getElementById("sentamount").innerHTML = decoder;
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

        // END BUY Cable \\
    </script>
@endpush

@push('breadcrumb-plugins')
<a href="{{ route('user.cabletv.history') }}" class="back-btn">
    <i class="icon" data-feather="grid"></i>
  </a>
@endpush
