@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- End Row -->
    <!--begin::Content-->
    <div class="row">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class=" container-xxl ">

                <!--begin::Row-->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-xxl-8">
                        <div
                            style="height:560px; background-color: hsl(0, 0%, 100%); overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;">
                            <div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe
                                    src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id={{ $coin->code }}&pref_coin_id=1505"
                                    width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0"
                                    frameborder="0" border="0"
                                    style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div>
                            <div
                                style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                                <a href="https://coinlib.io" target="_blank"
                                    style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency
                                    @lang('Powered')</a>&nbsp;by {{ __($general->site_name) }}
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xxl-4">

                        <!--begin::Engage widget 1-->
                        <div class="card h-md-100" dir="ltr">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column flex-center">
                                <!--begin::Heading-->
                                <div class="mb-2">
                                    <!--begin::Title-->
                                    <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                                        {{ $coin->name }} @lang('Balance')<br>
                                        <span class="fw-bolder">
                                            {{ $wallet->balance }}<small>{{ strToUpper($coin->symbol) }}</small></span><br>
                                        <span class="fw-bolder">
                                            <h4 id="USDBALANCE"><i class="fa fa-spinner fa-spin"></i></h4>
                                        </span>

                                    </h1>
                                    <!--end::Title-->

                                    <!--begin::Illustration-->
                                    <div class="py-10 text-center">
                                        <img src="{{ $wallet->qrcode }}" class=" w-200px" alt="" />
                                        <div class="input-group">
                                            <input type="text"id="walletaddress" value="{{ $wallet->address }}" readonly
                                                class="form-control" placeholder="Right Side"
                                                aria-describedby="basic-addon2">
                                            <button onclick="myFunction()" class="btn btn-primary" type="button">
                                                <a class="ti ti-link text-white"></a>
                                            </button>
                                        </div>

                                    </div>
                                    <!--end::Illustration-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Links-->
                                <div class="text-center mb-1">
                                    <!--begin::Link-->
                                   
                                    <!--begin::Link-->
                                    <a class="btn btn-sm btn-dark mb-1"
                                        href="{{ route('user.crypto.wallet.trx', $wallet->address) }}">
                                        @lang('Transaction Log') </a>
                                    <!--end::Link-->

                                    <!-- ------------------------------------------ -->
                      <!-- Large -->
                      <!-- ------------------------------------------ -->
                      <button class="btn btn-sm btn-info me-2 mb-1"
                      data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">
                      @lang('Send ') {{ $coin->name }}
                    </button>
                    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1"
                      aria-labelledby="bs-example-modal-lg" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                       <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>@lang('Send') {{ $coin->name }}</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ti ti-trash fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_new_card_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                <span class="required">@lang('Wallet Address')</span>


                                <span class="ms-1" data-bs-toggle="tooltip" title="Enter beneficiary wallet address">
                                    <i class="ki-duotone ti ti-alert-circle text-gray-500 fs-6"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span></i></span> </label>
                            <!--end::Label-->

                            <input type="text" class="form-control form-control-solid" onkeyup="validatewallet()"
                                placeholder="Enter wallet address" id="address" />
                            <div id="getwallet"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">@lang('Amount')</label>
                            <!--end::Label-->

                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <div class="input-group input-group-solid mb-5">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control form-control-solid" disabled
                                        onkeyup="exchange()" placeholder="0.00USD" id="amount" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <!--begin::Input-->
                            <!--end::Input-->
                            <div id="getrate"></div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-10">
                            <!--begin::Input group-->
                            <div class="d-flex flex-stack">
                                <div id="walletalert"></div>
                            </div>
                            <!--end::Input group-->


                            <!--begin::Actions-->
                            <div class="text-center pt-15">

                                <button onclick="sendcoin()" id="submit" disabled class="btn btn-primary">
                                    <span class="indicator-label">
                                        @lang('Send') {{ $coin->name }}
                                    </span>
                                    <div id="submitting"></div>
                                </button>
                            </div>


                            <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </div>
                  <div>
                    <!-- ------------------------------------------ -->
                    <!-- Medium -->
                    <!-- ------------------------------------------ -->
                    <button class="btn btn-sm btn-primary me-2 mb-1"
                      data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                      @lang('Swap ') {{ $coin->name }}
                    </button>
                    <!-- sample modal content -->
                    <div id="bs-example-modal-md" class="modal fade" tabindex="-1"
                      aria-labelledby="bs-example-modal-md" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>@lang('Swap') {{ $coin->name }}</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ti ti-trash fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="" class="form" action="#">

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">@lang('Amount')</label>
                            <!--end::Label-->

                            <!--begin::Input wrapper-->
                            <div class="position-relative">
                                <div class="input-group input-group-solid mb-5">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control form-control-solid"
                                        onkeyup="swap()" placeholder="0.00USD" id="swapamount" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <!--begin::Input-->
                            <!--end::Input-->
                            <div id="getswaprate"></div>
                            <!--end::Input wrapper-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-10">
                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button onclick="swapcoin()" id="swapbutton" disabled class="btn btn-primary">
                                    <span class="indicator-label">
                                        @lang('Swap') {{ $coin->name }}
                                    </span>
                                    <div id="submittingswap"></div>
                                </button>
                            </div>
                            <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </div>
                  <div>
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->



      



    @push('script')
        <script>
            function myFunction() {
                var copyText = document.getElementById("walletaddress");
                copyText.select();
                copyText.setSelectionRange(0, 99999); /*For mobile devices*/
                document.execCommand("copy");
                SlimNotifierJs.notification('success', 'Wallet Address Copied');

            }
        </script>
        <script>
            const coins = async () => {
                await fetch('https://data.messari.io/api/v1/assets')
                    .then(data => data.json())
                    .then(res => {
                        res.data.map(coin => {
                            let coinPrice = coin.metrics.market_data.price_usd
                            let coinPercent = coin.metrics.market_data.percent_change_usd_last_24_hours
                            var coinbalance = "{{ $wallet->balance }}"
                            var newBalance
                            switch (coin.symbol) {
                                case "{{ $coin->symbol }}":
                                    document.getElementById("USDBALANCE").innerHTML =
                                        `$${ parseInt(coinPrice*coinbalance).toLocaleString() } `
                                    break;

                                default:
                                    break;
                            }
                        })
                    })
            }

            coins()
        </script>
        <script>
            function validatewallet() {
                var address = document.getElementById("address").value;
                document.getElementById("walletalert").innerHTML = '';
                document.getElementById("amount").value = '';
                document.getElementById("amount").disabled = true;
                $("#getwallet").html(`
                      <div class="text-center"> <i class="fa fa-spinner fa-spin"></i></div>`);
                var raw = JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    address: address,
                });
                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("{{ route('user.crypto.wallet.validate', encrypt($coin->id)) }}", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        if (resp.ok == true) {
                            document.getElementById("amount").disabled = false;
                            $("#walletalert").html(
                                `<!--begin::Alert-->
                            <div class="alert alert-info d-flex align-items-center p-5">
                                <!--begin::Icon-->
                                <i class="ki-duotone ti ti-alert-circle fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column">
                                    <b class="text-danger">Address: ${address}</b>
                                    <!--begin::Content-->
                                    <span>@lang('Please confirm you have enter correct and intended wallet address.') {{ $general->site_name }} @lang('will not be liable to any loss arising from you entering a wrong wallet address')</span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->`
                            );

                        }
                        $("#getwallet").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                        );
                    })
                    .catch(error => {

                    });
            };
        </script>
        <script>
            function exchange() {
                var amount = document.getElementById("amount").value;
                document.getElementById("submit").disabled = true;
                $("#getrate").html(`
                    <div class="text-center">
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>`);
                var raw = JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                });
                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("{{ route('user.crypto.exchange', encrypt($coin->id)) }}", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        if (resp.balance == false) {
                            document.getElementById("submit").disabled = true;
                            $("#balance").html(
                                `<a class="badge bg-danger" href="javascript:void(0);">You dont have enought balance to intiate this transaction</a>`
                            );
                        }
                        document.getElementById("submit").disabled = false;
                        $("#getrate").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                        );
                    })
                    .catch(error => {

                    });
            };
        </script>
        <script>
            function swap() {
                var amount = document.getElementById("swapamount").value;
                document.getElementById("swapbutton").disabled = true;
                $("#getswaprate").html(`
                    <div class="text-center">
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>`);

                var raw = JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                });
                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("{{ route('user.crypto.exchange', encrypt($coin->id)) }}", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        if (resp.balance == false) {
                            document.getElementById("swapbutton").disabled = true;
                            $("#getswaprate").html(
                                `<a class="badge bg-danger" href="javascript:void(0);">You dont have enought balance to intiate this swap</a>`
                            );
                        }
                        document.getElementById("swapbutton").disabled = false;
                        if(resp.ok != true)
                        {
                            $("#getswaprate").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                            );
                            return;
                        }
                        else
                        {
                            var rate = "{{$coin->swap_rate}}";
                            var getvalue = amount*rate;
                            $("#getswaprate").html(`
                                <div class="text-center">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>`);

                            document.getElementById("swapbutton").disabled = false;
                            $("#getswaprate").html(
                                `<a class="badge bg-info text-white" href="javascript:void(0);">${getvalue}{{$general->cur_text}}</a>`
                            );
                        }
                    })
                    .catch(error => {

                    });

            };
        </script>
        <script>
            function swapcoin() {
                var amount = document.getElementById("swapamount").value;
                document.getElementById("swapbutton").disabled = true;
                $("#submittingswap").html(`
                <div class="text-center">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>`);
                var raw = JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                    source: "{{ $wallet->address }}",
                });

                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("{{ route('user.crypto.swap', encrypt($coin->id)) }}", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        document.getElementById("submit").disabled = false;
                        $("#submittingswap").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                        );
                    })
                    .catch(error => {

                    });
            };
        </script>

        <script>
            function sendcoin() {
                var amount = document.getElementById("amount").value;
                var address = document.getElementById("address").value;
                document.getElementById("submit").disabled = true;
                $("#submitting").html(`
                  <div class="text-center">
                    <i class="fa fa-spinner fa-spin"></i>
                  </div>`);
                var raw = JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                    address: address,
                    source: "{{ $wallet->address }}",
                });

                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("{{ route('user.crypto.send', encrypt($coin->id)) }}", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        document.getElementById("submit").disabled = false;
                        $("#submitting").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                        );
                    })
                    .catch(error => {

                    });
            };
        </script>
    @endpush
@endsection



@push('script')
@endpush
