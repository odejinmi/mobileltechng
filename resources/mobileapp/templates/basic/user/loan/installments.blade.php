@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- card start -->
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details">
          <div class="d-block w-75">
            <h5 class="fw-semibold">@lang('Loan Amount')</h5>
            <h2 class="mt-2">{{ showAmount($loan->amount) }} {{ $general->cur_text }}</h2>
          </div>
          <div class="price-difference">
            <i class="menu-icon" data-feather="gift"></i>
            <center><h6>{{ @$loan->plan->name }}</h6></center>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- card end -->
  <!-- card start -->
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details">
          <div class="d-block w-75">
            <h5 class="fw-semibold">@lang('Loan Repayment')</h5>
            <h2 class="mt-2">{{ $general->cur_sym . showAmount($loan->payable_amount) }}</h2>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- card end -->
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details">
          <div class="d-block w-75">
            <h5 class="fw-semibold">@lang('Total Repayment')</h5>
            <h2 class="mt-2"> {{ $general->cur_sym }}{{ showAmount($loan->charge_per_installment*$loan->given_installment) }}</h2>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- card end -->
  
@include($activeTemplate . 'partials.installment_table')
        
@endsection
 
