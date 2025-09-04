@extends($activeTemplate . 'layouts.dashboard')

@section('panel')
    <!-- pay money section starts -->
    <form class="" novalidate="novalidate" action="{{ route('user.deposit.insert') }}" method="post">
        @csrf
        <section class="pay-money section-b-space">
            <div class="custom-container">
                <div class="profile-pic">
                    <img class="img-fluid img" src="{{ asset('assets/assets/dist/images/backgrounds/wallet.webp') }}"
                        alt="p3" />
                </div>
                <h3 class="person-name">Balance: {{ number_format(Auth::user()->balance, 2) }}</h3>
                <h5 class="upi-id">APP ID : {{ Auth::user()->username }}</h5>
                
                @if(Auth::user()->nuban != null)
                @if ($general->nuban_provider == 'MONNIFY')
                    @php
                        $nuban = json_decode(Auth::user()->nuban, true);
                    @endphp
                    @foreach ($nuban as $data)
                        @if (isset($data['bankName']) && isset($data['accountName']))
                        <!-- Bank Details Start -->
                        <section>
                            <div class="custom-container">
                            <div class="statistics-banner">
                                <div class="d-flex justify-content-center gap-3">
                                <div class="statistics-image">
                                    <i class="icon" data-feather="user"></i>
                                </div>
                                <div class="statistics-content d-block">
                                    <h5>@lang('Bank Name'): {{@$data['bankName'] ?? null}}</h5>
                                    <h6>@lang('Account Name'): {{@$data['accountName']}}</h6>
                                    <h6>@lang('Account Number'): {{@$data['accountNumber']}}</h6>
                                </div>
                                </div>
                            </div>
                            </div>
                        </section>
                        <!-- Bank Details Ends -->
                        @endif
                    @endforeach
                @elseif($general->nuban_provider == "STROWALLET" ||
                                    $general->nuban_provider == 'PAYVESSEL')
                @php
                $bankdetails = json_decode(Auth::user()->nuban);
                @endphp
                <!-- Bank Details Start -->
                <section>
                <div class="custom-container">
                <div class="statistics-banner">
                    <div class="d-flex justify-content-center gap-3">
                    <div class="statistics-image">
                        <i class="icon" data-feather="user"></i>
                    </div>
                    <div class="statistics-content d-block">
                        <h5>@lang('Bank Name'): {{@$bankdetails->bank_name}}</h5>
                        <h6>@lang('Account Name'): {{@$bankdetails->account_number}}</h6>
                        <h6>@lang('Account Number'): {{@$bankdetails->account_name}}</h6>
                    </div>
                    </div>
                </div>
                </div>
                </section>
                <!-- Bank Details Ends -->
                @elseif($general->nuban_provider == "PAYLONY")
                @php
                $bankdetails = json_decode(Auth::user()->nuban);
                @endphp
                <!-- Bank Details Start -->
                <section>
                    <div class="custom-container">
                    <div class="statistics-banner">
                        <div class="d-flex justify-content-center gap-3">
                        <div class="statistics-image">
                            <i class="icon" data-feather="user"></i>
                        </div>
                        <div class="statistics-content d-block">
                            <h5>@lang('Bank Name'): {{@$bankdetails->bank_name}}</h5>
                            <h6>@lang('Account Name'): {{@$bankdetails->account_number}}</h6>
                            <h6>@lang('Account Number'): {{@$bankdetails->account_name}}</h6>
                        </div>
                        </div>
                    </div>
                    </div>
                    </section>
                    <!-- Bank Details Ends -->
                @endif
                @else
                
                <a href="#" id="fundbutton" onclick="generatenuban()" class="btn theme-btn w-100 btn-sm">
                    @lang('Generate') </a>
                <!--end::Action-->
                <center><div id="responsemessage"></div></center>
                @push('script')
                <script>
                function generatenuban() {
                    // START GET DATA \\  
                    
                    document.getElementById("fundbutton").disabled = true;
                    $("#responsemessage").html(`<br>
                        <span class="spinner-border text-primary" role="status"></span>
                        <span class="text-gray-800 fs-6 fw-semibold mt-5">Generating...</span>
                    `);
                    // Show page loading
                    var _token = $("input[name='_token']").val(); 
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
                    fetch("{{ route('user.generate.nuban') }}", requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            resp = JSON.parse(result);
                            document.getElementById("fundbutton").disabled = false; 
                            $("#responsemessage").html(
                                `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                                ); 
                            if(resp.status == 'success')
                            {
                                location.reload();
                            }
                        })
                        .catch(error => {
                        console.info(error);
                        });
                    // END GET DATA \\


                }
                </script>
                @endpush

                @endif
                <div class="form-group">
                    <div class="form-input mt-4">
                        <input type="number" class="form-control" placeholder="{{ $general->cur_sym }}0.00" id="amount"
                            name="amount" />
                    </div>
                </div>


                <center>
                    <ul class="nav nav-pills tab-style3 w-100 mt-3" id="myTab" role="tablist">
                        <li class="nav-item w-25" onclick="setamount(200)" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                                type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">{{ $general->cur_sym }}200</button>
                        </li>
                        <li class="nav-item w-25" onclick="setamount(500)" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">{{ $general->cur_sym }}500</button>
                        </li>
                        <li class="nav-item w-25" onclick="setamount(1000)" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">{{ $general->cur_sym }}1k</button>
                        </li>
                        <li class="nav-item w-25" onclick="setamount(2000)" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">{{ $general->cur_sym }}2k</button>
                        </li>
                    </ul>
                </center>

                @push('script')
                    <script>
                        function setamount(amount) {
                            document.getElementById("amount").value = amount;
                        }
                    </script>
                @endpush

                <ul class="card-list">
                    @forelse ($gatewayCurrency as $data)
                        <li class="payment-add-box">
                            <div class="add-img">
                                <img class="img-fluid img"
                                    src="{{ getImage(imagePath()['gateway']['path'] . '/' . $data->method->image, imagePath()['gateway']['size']) }}"
                                    alt="card1" />
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">{{ __($data->name) }}</h5>
                                    <h6 class="mt-2 light-text">{{ $general->cur_sym }}{{ showAmount($data->min_amount) }}
                                        -
                                        {{ $general->cur_sym }}{{ showAmount($data->max_amount) }}</h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input methodId" value="{{ $data }}"
                                        {{ old('methodId') == $data->id ? ' checked' : '' }} type="radio" name="methodId"
                                        data-resource="{{ $data }}" id="{{ $data->id }}" />
                                </div>
                            </div>
                        </li>

                    @empty
                        {!! emptyData() !!}
                    @endforelse
                </ul>

                <input type="hidden" name="currency" class="edit-currency form-control">
                <input type="hidden" name="method_code" class="edit-method-code  form-control">
                <a type="button" data-bs-toggle="modal" href="#deposit-now" class="btn theme-btn w-100">Deposit now</a>
            </div>
        </section>
        <!-- pay money section end -->

        <!-- transaction detail modal start -->
        <div class="modal successful-modal transfer-details fade" id="deposit-now" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="method">Payment Detail<br>
                        </h2>
                    </div>
                    <div class="modal-body">
                        <ul class="details-list">
                            <li>
                                <h3 class="fw-normal dark-text">@lang('Fixed charge')</h3>
                                <h3 class="fw-normal light-text" id="fixed_charge"></h3>
                            </li>
                            <li>
                                <h3 class="fw-normal dark-text">@lang('Percentage charge')</h3>
                                <h3 class="fw-normal light-text" id="percentage_charge"></h3>
                            </li>
                            <li>
                                <h3 class="fw-normal dark-text">@lang('Minimum Amount')</h3>
                                <h3 class="fw-normal light-text" id="min_limit"></h3>
                            </li>
                            <li>
                                <h3 class="fw-normal dark-text">@lang('Maximum Amount')</h3>
                                <h3 class="fw-normal light-text" id="max_limit"></h3>
                            </li>
                            <li class="amount">
                                <h3 class="fw-normal dark-text"></h3>
                                <h3 class="fw-semibold error-color">
                                    <button type="submit" href="#" class="btn theme-btn w-100">Proceed</button>
                                </h3>
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                        <i class="icon" data-feather="x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- successful transfer modal end -->
    </form>
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('user.deposit.history') }}" class="back-btn">
        <i class="icon" data-feather="printer"></i>
    </a>
@endpush


@push('script')
    <script>
        'use strict';
        $(document).ready(function() {

            $(document).on('input', 'input[name="amount"]', function() {
                let limit = '2';
                let amount = $(this).val();
                let fraction = amount.split('.')[1];
                if (fraction && fraction.length > limit) {
                    amount = (Math.floor(amount * Math.pow(10, limit)) / Math.pow(10, limit)).toFixed(
                        limit);
                    $(this).val(amount);
                }
            });

            $(document).on('change, input', ".methodId", function(e) {
                var amount = document.getElementById("amount").value;
                let methodId = this.value;
                const errorlogs = JSON.stringify(methodId);
                const personObject = JSON.parse(methodId);
                // && amount < personObject.max_limit
                if (personObject.id) {
                    //$('.method_currency').text(resource.currency);
                    $('input[name=currency]').val(personObject.currency);
                    $('input[name=method_code]').val(personObject.method_code);

                    $('.showCharge').removeClass('d-none');
                    $('#method').html(personObject.name);
                    $('#fixed_charge').html(parseFloat(personObject.fixed_charge) +
                        '{{ __($general->cur_text) }}');
                    $('#percentage_charge').html(personObject.percent_charge +
                        '{{ __($general->cur_text) }} ');
                    $('#min_limit').html(parseFloat(personObject.min_amount) +
                        '{{ __($general->cur_text) }} ');
                    $('#max_limit').html(parseFloat(personObject.max_amount) +
                        '{{ __($general->cur_text) }} ');
                } else {
                    $('.showCharge').addClass('d-none');
                }

            });
        });
    </script>
@endpush
