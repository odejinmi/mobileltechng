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
      <form role="form" id="payment-form" method="{{ $data->method }}" action="{{ $data->url }}">
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
          <input type="hidden" value="{{ $data->track }}" name="track">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">@lang('Name on Card')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form--control" name="name"
                                        value="{{ old('name') }}" required autocomplete="off" autofocus />
                                    <span class="input-group-text"><i class="fa fa-font"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('Card Number')</label>
                                <div class="input-group">
                                    <input type="tel" class="form-control form--control" name="cardNumber"
                                        autocomplete="off" value="{{ old('cardNumber') }}" required autofocus />
                                    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label class="form-label">@lang('Expiration Date')</label>
                                <input type="tel" class="form-control form--control" name="cardExpiry"
                                    value="{{ old('cardExpiry') }}" autocomplete="off" required />
                            </div>
                            <div class="col-md-6 ">
                                <label class="form-label">@lang('CVC Code')</label>
                                <input type="tel" class="form-control form--control" name="cardCVC"
                                    value="{{ old('cardCVC') }}" autocomplete="off" required />
                            </div>
                        </div>

        <button type="submit" class="btn theme-btn w-100 mt-3"
            id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
        
    </form>

      

    </div>
  </section> 
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/card.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            var card = new Card({
                form: '#payment-form',
                container: '.card-wrapper',
                formSelectors: {
                    numberInput: 'input[name="cardNumber"]',
                    expiryInput: 'input[name="cardExpiry"]',
                    cvcInput: 'input[name="cardCVC"]',
                    nameInput: 'input[name="name"]'
                }
            });
        })(jQuery);
    </script>
@endpush
