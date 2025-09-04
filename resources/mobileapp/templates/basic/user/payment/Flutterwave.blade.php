@extends($activeTemplate . 'layouts.dashboard')

@section('panel')
 <!-- pay money section starts -->
 <section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" src="{{ getImage(imagePath()['gateway']['path'] . '/' . @$deposit->gateway->image, imagePath()['gateway']['size']) }}" alt="p3" />
      </div>
      <h3 class="person-name">Make Payment</h3>
      <h5 class="upi-id">Method : {{$deposit->gateway->alias}}</h5>
       

      <form action="#" method="POST" class="text-center">
        @csrf 
        <ul class="card-list">
            <li class="payment-add-box">
              <div class="add-img"> 
                <div class="categories-box">
                    <i class="categories-icon" data-feather="shopping-cart"></i>
                </div>
              </div>
              <div class="add-content">
                <div>
                  <h5 class="fw-semibold dark-text">Amount</h5>
                  <h6 class="mt-2 light-text"></h6>
                </div> 

                <div class="form-check">
                    {{ showAmount($deposit->final_amo) }}
                    {{ __($deposit->method_currency) }}
                  </div>
              </div>
            </li> 

            <li class="payment-add-box">
                <div class="add-img">
                  <div class="categories-box">
                      <i class="categories-icon" data-feather="percent"></i>
                  </div>
                </div>
                <div class="add-content">
                  <div>
                    <h5 class="fw-semibold dark-text">Fee</h5>
                    <h6 class="mt-2 light-text"></h6>
                  </div> 
  
                  <div class="form-check">
                      {{ showAmount($deposit->charge) }} {{ __($deposit->method_currency) }}
                    </div>
                </div>
              </li>
    
            <li class="payment-add-box">
              <div class="add-img">
                <div class="categories-box">
                    <i class="categories-icon" data-feather="shopping-bag"></i>
                </div>
              </div>
              <div class="add-content">
                <div>
                  <h5 class="fw-semibold dark-text">You Get</h5>
                  <h6 class="mt-2 light-text"></h6>
                </div> 

                <div class="form-check">
                    {{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}
                  </div>
              </div>
            </li>
          </ul>
        <button type="button" class="btn theme-btn w-100 mt-3"
            id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
        
    </form>

      

    </div>
  </section>
 
@endsection
@push('script')
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script>
        "use strict"
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "{{ $data->API_publicKey }}";

        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{ $data->customer_email }}",
                amount: "{{ $data->amount }}",
                customer_phone: "{{ $data->customer_phone }}",
                currency: "{{ $data->currency }}",
                txref: "{{ $data->txref }}",
                onclose: function() {},
                callback: function(response) {
                    var txref = response.tx.txRef;
                    var status = response.tx.status;
                    var chargeResponse = response.tx.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    } else {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    }
                    // x.close(); // use this to close the modal immediately after payment.
                }
            });
        }
    </script>
@endpush
