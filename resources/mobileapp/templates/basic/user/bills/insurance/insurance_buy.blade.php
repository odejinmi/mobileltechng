@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <!-- banner section starts -->
    
    <!-- banner section starts -->
    <section>
        <div class="custom-container">
          <div class="swiper banner">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#">
                  <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/insurance1.png')}}" alt="banner1" />
                </a>
              </div>
    
              <div class="swiper-slide">
                <a href="#">
                  <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/insurance2.png')}}" alt="banner2" />
                </a>
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>
      <!-- banner section end -->

    <!-- banner section end -->
    <section class="section-b-space" id="step1">
        <div class="custom-container">
            <div class="currency-transfer">
                <form class="auth-form crypto-form" id="insurancedetails">
                    <div class="form-group">
                        <label for="inputassets" class="form-label mb-0">Insurance Policy</label>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    id="insurancename">Select Provider</a>

                                <ul class="dropdown-menu">
                                    @foreach ($providers as $data)
                                        <li onclick="populate('{{ $data['code'] }}','{{ $data['name'] }}')">
                                            <a class="dropdown-item " style="word-wrap: break-word;"> <i class="iconsax categories-icon"
                                                    data-feather="umbrella"></i>
                                                {{ strToUpper($data['name']) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <input id="variation_code" hidden>
                        <input id="variation_name" hidden>
                        <input id="serviceID" hidden>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <h5 class="light-text mb-0" id="minimum"></h5>
                            <h5 class="theme-color fw-normal mb-0" id="maximum"></h5>
                        </div>
                    </div>
                    <div class="pay-money">
                        <center>
                            <div id="providers"></div>
                        </center>
                    </div>

                    <div class="pay-money">
                        <div id="customerdetails"></div>
                    </div>
                    <center>
                        <div id="loader"></div>
                    </center>


                    <section class="pay-money section-b-space">
                        @push('script')
                            <script>
                                function populate(code, name) {
                                    // START GET DATA \\
                                    document.getElementById('loader').innerHTML = `
                                <span class="spinner-border text-primary" role="status"></span>
                                <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
                            `;
                                    document.getElementById("customerdetails").innerHTML = '';
                                    document.getElementById("submit").disabled = true;

                                    // Show page loading
                                    document.getElementById('providers').innerHTML = '';
                                    document.getElementById('insurancename').innerHTML = name;
                                    document.getElementById("serviceID").value = code;
                                    var _token = $("input[name='_token']").val();
                                    $.ajax({
                                        url: "{{ route('user.insurance.operators') }}",
                                        type: 'GET',
                                        async: true,
                                        data: {
                                            _token: _token,
                                            code: code
                                        },
                                        cache: false,
                                        dataType: "json",
                                        success: function(data) {
                                            if (data.status == 'true') {
                                                var plans = data.content.varations;
                                                var image = data.image;
                                                console.info(plans);
                                                let html = '';
                                                plans.map(plan => {

                                                    let htmlSegment =
                                                        `
                                                <li class="payment-add-box mb-1">
                                                <div class="add-img">
                                                    <img src="${image}" width="30" class="path1"/>
                                                </div>
                                                <div class="add-content">
                                                    <div>
                                                    <h5 class="fw-semibold dark-text">${plan['name']}</h5>
                                                    <h6 class="mt-2 light-text">{{ $general->cur_sym }}${plan['variation_amount']}</h6>
                                                    </div>
                                                    <div class="form-check">
                                                    <input onchange="networkprovider('${plan['variation_code']}','${plan['variation_amount']}','${code}','${plan['name']}')"  class="form-check-input" type="radio" value="3" name="plan" />
                                                    </div>
                                                </div>
                                                </li>
                                                `;
                                                    html += htmlSegment;
                                                });

                                                document.getElementById('providers').innerHTML =
                                                    `<ul class="card-list">
                                                    ${html} </ul>
                                                `;

                                                $("#loader").html('');
                                            } else {
                                                $("#loader").html('');
                                            }

                                        }
                                    });
                                    // END GET DATA \\
                                }
                            </script>
                            <script>
                                function networkprovider(variation_code, planamount, code, name) {

                                    document.getElementById("variation_code").value = variation_code;
                                    document.getElementById("variation_name").value = name;

                                    if (code == 'ui-insure') {
                                        document.getElementById("submit").disabled = false;
                                        document.getElementById('shownow').classList.remove('d-none'); 
                                        document.getElementById("customerdetails").innerHTML =
                                            `
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The plate Number of the vehicle you wish to make the insurance payment on.')</label>
                                        <input name="billersCode" id="billersCode" class="form-control reason"/>
                                    </div>
                                    </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The phone number of the customer or recipient of this service')</label>
                                        <input name="phone" id="phone" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Name of the owner of the insured vehicle')</label>
                                        <input name="Insured_Name" id="Insured_Name" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id=""> 
                                        <label class="form-label required">@lang('Engine Number of the insured vehicle')</label>
                                        <input name="Engine_Number" id="Engine_Number" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Chasis Number of the insured vehicle')</label>
                                        <input name="Chasis_Number" id="Chasis_Number" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Make of the insured vehicle')</label>
                                        <input name="Vehicle_Make" id="Vehicle_Make" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Vehicle color')</label>
                                        <input name="Vehicle_Color" id="Vehicle_Color" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Model of the insured vehicle')</label>
                                        <input name="Vehicle_Model" id="Vehicle_Model" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The year the insured vehicle was made')</label>
                                        <input name="Year_of_Make" id="Year_of_Make" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Contact Address of the vehicle owner')</label>
                                        <input name="Contact_Address" id="Contact_Address" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Amount to be paid')</label>
                                        <input name="amount" id="amount" value="${planamount}" class="form-control reason"/>
                                    </div> </div>
                                    `;
                                    } else if (code == 'personal-accident-insurance') {
                                        document.getElementById("submit").disabled = false;
                                        document.getElementById('shownow').classList.remove('d-none'); 
                                        document.getElementById("customerdetails").innerHTML =
                                            `
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The Full name of the person you wish to make the insurance payment on')</label>
                                        <input name="billersCode" id="billersCode" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The phone number of the customer or recipient of this service')</label>
                                        <input name="phone" id="phone" class="form-control reason"/>
                                    </div>  </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The Address of the person you wish to make the insurance payment on.')</label>
                                        <input name="address" id="address" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('The date of birth of the person insured in for of YYYY-mm-dd.')</label>
                                        <input name="dob" id="dob" type="date" class="form-control reason "/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id=""> 
                                        <label class="form-label required">@lang('Customer’s next of kin name.')</label>
                                        <input name="next_kin_name" id="next_kin_name" class="form-control reason"/>
                                    </div> </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Customer’s next of kin phone number.')</label>
                                        <input name="next_kin_phone" id="next_kin_phone" class="form-control reason"/>
                                    </div>  </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Customer’s business occupation.')</label>
                                        <input name="business_occupation" id="business_occupation" class="form-control reason"/>
                                    </div>  </div>
                                    <div class="form-group mt-3">
                                    <div class="form-input" id="">
                                        <label class="form-label required">@lang('Amount to be paid')</label>
                                        <input name="amount" id="amount" value="${planamount}" class="form-control reason"/>
                                    </div> </div>
                                    
                                    `;
                                    } else {
                                        document.getElementById("customerdetails").innerHTML = `<center><span class="mt-3 badge bg-danger">Plan Not Found</span></center>`;
                                    }

                                }
                            </script>
                        @endpush
                        <div class="form-group d-none" id="shownow">
                            <div class="form-input mt-3">
                                <input type="number" id="password" autocomplete="new-password" maxlength="6"
                                    class="form-control reason" name="code" placeholder="Transaction PIN" />
                            </div>
                        </div>
                    </section>

                    <div class="transfer-btn">
                        <div class="custom-container">
                            <button type="button" disabled onclick="submitform()" id="submit"
                                class="btn theme-btn sub-btn  w-100">Process Request</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>



@stop

@push('breadcrumb-plugins')
    <a href="{{ route('user.insurance.history') }}" class="back-btn">
        <i class="icon" data-feather="grid"></i>
    </a>
@endpush
@push('script')
<script> 
                                             // START BUY Utility \\
                                            function submitform()
                                            {
                                              $("#loader").html(``);
                                              var serviceprovider = document.getElementById('serviceID').value;
                                              if(serviceprovider === 'ui-insure')
                                            {
                                                var url = "{{ route('user.buy.insurance.motor') }}";
                                                var raw = JSON.stringify({
                                                  _token: "{{ csrf_token() }}", 
                                                  password : document.getElementById('password').value, 
                                                  variation_code : document.getElementById('variation_code').value, 
                                                  variation_name : document.getElementById('variation_name').value,   
                                                  serviceID : document.getElementById('serviceID').value,  
                                                  billersCode : document.getElementById('billersCode').value,  
                                                  amount : document.getElementById('amount').value, 
                                                  phone : document.getElementById('phone').value,  
                                                  Insured_Name :document.getElementById('Insured_Name').value, 
                                                  Engine_Number :document.getElementById('Engine_Number').value, 
                                                  Chasis_Number :document.getElementById('Chasis_Number').value, 
                                                  Vehicle_Make :document.getElementById('Vehicle_Make').value, 
                                                  Vehicle_Color :document.getElementById('Vehicle_Color').value, 
                                                  Vehicle_Model :document.getElementById('Vehicle_Model').value, 
                                                  Year_of_Make :document.getElementById('Year_of_Make').value, 
                                                  Contact_Address :document.getElementById('Contact_Address').value, 
                                                  wallet :localStorage.getItem('wallet'), 
                                                });
                                            }

                                              else if(serviceprovider === 'personal-accident-insurance')
                                            {
                                                var url = "{{ route('user.buy.insurance.personal') }}";
                                                var raw = JSON.stringify({
                                                  _token: "{{ csrf_token() }}", 
                                                  password : document.getElementById('password').value, 
                                                  variation_code : document.getElementById('variation_code').value, 
                                                  variation_name : document.getElementById('variation_name').value,   
                                                  serviceID : document.getElementById('serviceID').value,  
                                                  billersCode : document.getElementById('billersCode').value,  
                                                  amount : document.getElementById('amount').value, 
                                                  phone : document.getElementById('phone').value,  
                                                  address :document.getElementById('address').value, 
                                                  dob :document.getElementById('dob').value, 
                                                  next_kin_name :document.getElementById('next_kin_name').value, 
                                                  next_kin_phone :document.getElementById('next_kin_phone').value, 
                                                  business_occupation :document.getElementById('business_occupation').value, 
                                                  wallet :localStorage.getItem('wallet'), 
                                                });
                                            }
                                              else 
                                            {
                                                var raw = JSON.stringify({
                                                  _token: "{{ csrf_token() }}", 
                                                  password : document.getElementById('password').value, 
                                                  variation_code : document.getElementById('variation_code').value, 
                                                  variation_name : document.getElementById('variation_name').value,   
                                                  serviceID : document.getElementById('serviceID').value,  
                                                  billersCode : document.getElementById('billersCode').value,   
                                                });
                                            }

                                                var requestOptions = {
                                                  method: 'POST',
                                                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                  body: raw
                                                };
                                                fetch(url, requestOptions)
                                                  .then(response => response.text())
                                                  .then(result => 
                                                  {
                                                    resp = JSON.parse(result);
                                                     
                                                   $("#loader").html(`<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`);
                                                  }
                                                  )
                                                  .catch(error => 
                                                  {
                                                    
                                                  }
                                                  ); 
                                            }
                                            // END BUY Utility \\
</script>
@endpush