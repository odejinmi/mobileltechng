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
       

      <form action="{{ $data->url }}" method="{{ $data->method }}">
        <input type="hidden" custom="{{ $data->custom }}" name="hidden">
        <script src="{{ $data->checkout_js }}"
            @foreach ($data->val as $key => $value)
                data-{{ $key }}="{{ $value }}" @endforeach>
        </script>
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
        
        
    </form>

      

    </div>
  </section>
  
@endsection


@push('script')
    <script>
        (function($) {
            "use strict";
            $('input[type="submit"]').addClass("mt-4 btn btn-outline-primary w-100");
        })(jQuery);
    </script>
@endpush
