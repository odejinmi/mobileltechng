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
            id="btn-confirm">@lang('Pay Now')</button>
        
    </form>

      

    </div>
  </section>
 
@endsection
@push('script')
    <script src="//pay.voguepay.com/js/voguepay.js"></script>
    <script>
        "use strict";
        var closedFunction = function() {}
        var successFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }
        var failedFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id }}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{ $data->cur }}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo: "{{ $data->memo }}",
                recurrent: true,
                frequency: 10,
                developer_code: '60a4ecd9bbc77',
                custom: "{{ $data->custom }}",
                customer: {
                    name: 'Customer name',
                    country: 'Country',
                    address: 'Customer address',
                    city: 'Customer city',
                    state: 'Customer state',
                    zipcode: 'Customer zip/post code',
                    email: 'example@example.com',
                    phone: 'Customer phone'
                },
                closed: closedFunction,
                success: successFunction,
                failed: failedFunction
            });
        }
        (function($) {
            $('#btn-confirm').on('click', function(e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        })(jQuery);
    </script>
@endpush
