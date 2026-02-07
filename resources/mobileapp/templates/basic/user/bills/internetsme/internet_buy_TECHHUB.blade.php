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

    <!-- Withdraw section starts -->
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
                    <label for="amount" class="form-label">@lang('Select Country')</label>
                    <select name="country" class="form-select form-select-solid" data-control="select22"
                        id="youSendCurrency" data-hide-search="false" onchange="populate()"
                        data-placeholder="@lang('Select Country')">
                        <option selected disableds>@lang('Select a Country')...</option>
                        <option value="nigeria" data-callingCode="NG" data-countrycurrency="NGN" data-isoName="NG"
                            data-countrycontinent="Africa" data-network="{{ $networks }}" value="Nigeria"
                            data-icon="currency-flag currency-flag-ng me-1">Nigeria</option>
                    </select>
                </div>
                @push('script')
                    <script>
                        function populate() {
                            // START GET DATA \\

                            document.getElementById('providers').innerHTML = '';
                            var network = $("#youSendCurrency option:selected").attr('data-network');
                            document.getElementById("amountlist").innerHTML = ``;

                            networks = JSON.parse(network);
                            let html = '';
                            networks.map(plan => {
                                let htmlSegment =
                                    `
                                    <div class="col-12 mb-1">
                                            <div class="transaction-box">
                                                <a href="#" class="d-flex gap-3">
                                                    <div class="transaction-image color1">
                                                        <img src="{{ url('/') }}/assets/images/provider/${plan['logo']}" width="30" class="path1"/>
                                                    </div>
                                                    <div class="transaction-details">
                                                        <div class="transaction-name pb-0">
                                                            <h5>${plan['name']}<br>
                                                               <small> SME Data & Gifting</small>
                                                            </h5>
                                                            <h5 class="dark-text fw-semibold">
                                                                <div class="option d-block mt-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input"   type="radio"onchange="networkprovider('${plan['networkid']}','${plan['logo']}','${plan['name']}','${plan['networkid']}')"
                                                                                name="operator" id="${plan['networkid']}" value="${plan['networkid']}" />
                                                                        <label class="form-check-label" for="${plan['networkid']}"></label>
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
                                `${html}`;
                        }
                        // END GET DATA \\
                    </script>

                    <script>
                        function networkprovider(operatorId, image, name, networkid) {
                            document.getElementById("networkid").value = networkid;

                            var raw = JSON.stringify({
                                _token: "{{ csrf_token() }}",
                            });

                            var requestOptions = {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                body: raw
                            };
                            fetch("{{ route('user.internet_sme.operatorsInternetdetailsTECHHUB') }}", requestOptions)
                                .then(response => response.text())
                                .then(result => {
                                    // Function to filter plans based on selected category
                                    function filterPlans(selectedCategory, event) {
                                        if (event) event.preventDefault(); // Prevents the default behavior (form submission)

                                        let filteredHtml = ""; // Reset filtered HTML
                                        plans.map(plan => {
                                            if (plan['network'].toUpperCase() === name.toUpperCase() && plan.category === selectedCategory) {
                                                filteredHtml +=
                                                    `<div class="col-12 mb-1">
                                            <div class="transaction-box">
                                                <a href="#" class="d-flex gap-3">
                                                    <div class="transaction-image color1">
                                                        <img src="{{ url('/') }}/assets/images/provider/${image}" width="30" class="path1"/>
                                                    </div>
                                                    <div class="transaction-details">
                                                        <div class="transaction-name pb-0">
                                                            <h5>${plan['network']} ${plan['plan_name']} <br>
                                                               <small> ${plan['amount']}NGN</small>
                                                            </h5>
                                                            <h5 class="dark-text fw-semibold">
                                                                <div class="option d-block mt-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" onchange="setamount(this)" type="radio" name="type"
                                                                          name="operator" id="${plan['plan_id']}" value="${plan['plan_name']}|${plan['amount']}|${plan['plan_id']}|${name}" />
                                                                        <label class="form-check-label" for="${plan['plan_id']}"></label>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>`;
                                            }
                                        });

                                        // Update the plan list in the DOM
                                        document.getElementById("amountlist").innerHTML = ` ${filteredHtml}`;
                                    }

                                    // Ensure this function is accessible globally
                                    window.filterPlans = filterPlans;

                                    const plans = JSON.parse(result);
                                    const categories = [...new Set(plans.map(plan => plan.category))];
                                    let categoryhtml = ""; // Initialize category HTML
                                    let html = ""; // Initialize plans HTML

                                    // Generate category buttons with click event to filter plans
                                    categories.map(category => {
                                         categoryhtml += `
                                                                            <button type="button" class="btn btn-primary category-btn" onclick="filterPlans('${category}', event)">
                                                                                ${category}
                                                                            </button>`;

                                    });
                                    // Initial rendering of all plans
                                    plans.map(plan => {
                                        if (plan['network'].toUpperCase() === name.toUpperCase()) {
                                            html +=
                                                `<div class="col-12 mb-1">
                                            <div class="transaction-box">
                                                <a href="#" class="d-flex gap-3">
                                                    <div class="transaction-image color1">
                                                        <img src="{{ url('/') }}/assets/images/provider/${image}" width="30" class="path1"/>
                                                    </div>
                                                    <div class="transaction-details">
                                                        <div class="transaction-name pb-0">
                                                            <h5>${plan['network']} ${plan['plan_name']} <br>
                                                               <small> ${plan['amount']}NGN</small>
                                                            </h5>
                                                            <h5 class="dark-text fw-semibold">
                                                                <div class="option d-block mt-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" onchange="setamount(this)" type="radio" name="type"
                                                                          name="operator" id="${plan['plan_id']}" value="${plan['plan_name']}|${plan['amount']}|${plan['plan_id']}|${name}" />
                                                                        <label class="form-check-label" for="${plan['plan_id']}"></label>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>`;
                                        }
                                    });
                                    document.getElementById("amountlist").innerHTML = ` ${html}`;
                                    document.getElementById("categorylist").innerHTML = ` ${categoryhtml}`;

                                })
                                .catch(error => {
                                        console.log(error);
                                    }

                                );

                        }
                        // END GET OPERATORS
                    </script>
                    <script>
                        function setamount(input) {
                            document.getElementById("amount").value = input.value;
                            document.getElementById("networkname").value = input.value.split('|')[3];
                            document.getElementById("data_plan").value = input.value.split('|')[2];
                        }
                    </script>
                @endpush


                <div class="form-group">
                    <!--begin::Options-->
                    <div id="providers"></div>
                    <input id="data_plan" name="data_plan" hidden>
                    <input id="networkid" name="networkid" hidden>
                    <input id="networkname" name="networkname" hidden>
                    <input name="amount" hidden id="amount" />

                    <!--end::Options-->
                </div>
                <!--begin::Input group-->
                <div class="form-group">
                    <label for="amount" class="form-label">
                        @lang('Select Plan')</label>
                    <div id="categorylist"></div>
                    <br>
                    <!--begin::Fixed Amount-->
                    <div id="amountlist"></div>
                    <!--end::Fixed Amount-->
                </div>
                <!--end::Input group-->

                <div class="form-group">
                    <label class="form-label mb-3"> <a id="serviceprovider"></a> @lang('Phone Number')</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input name="phone" id="phone" class="form-control" />
                </div>


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
        function submitform() {
            $("#passmessage").html(
                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
            );
            document.getElementById("submit").disabled = true;

            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                password: document.getElementById('password').value,
                networkname: document.getElementById('networkname').value,
                amount: document.getElementById('amount').value,
                phone: document.getElementById('phone').value,
                networkid: document.getElementById('networkid').value,
                data_plan: document.getElementById('data_plan').value,
                wallet: localStorage.getItem('wallet'),
            });
            var networkname = document.getElementById('networkname').value;

            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("{{ route('user.buy.internet_sme_techhub') }}", requestOptions)
                .then(response => response.text())
                .then(result => {
                    resp = JSON.parse(result);
                    document.getElementById("sentamount").innerHTML = networkname;
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
    </script>
@endpush

@push('breadcrumb-plugins')
<a href="{{ route('user.internet_sme.history') }}" class="back-btn">
    <i class="icon" data-feather="grid"></i>
  </a>
@endpush
