@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
 <!-- content @s
-->
<!--begin::Container-->
<!-- Withdraw section starts -->
<section class="section-b-space">
    <div class="custom-container">
      <div class="title">
        <h4>Select Wallet</h4>
        <a href="{{route('user.p2p.history')}}">See all</a>

      </div>
        <form class="auth-form p-0" novalidate="novalidate" action="" method="post">
        @csrf

      <ul class="select-bank">
        <li>
          <div class="balance-box active">
            <input class="form-check-input" type="radio"  name="wallet" value="act_wallet"  checked />
            <img class="img-fluid balance-box-img active" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg')}}"
              alt="balance-box" />
            <img class="img-fluid balance-box-img unactive" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg')}}"
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
            <input class="form-check-input" type="radio" name="wallet" value="ref_wallet"  />
            <img class="img-fluid balance-box-img active" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg')}}"
              alt="balance-box" />
            <img class="img-fluid balance-box-img unactive" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg')}}"
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


        <div class="form-group">
          <label for="amount" class="form-label">Amount</label>
          <input type="number" id="amount" class="form-control amount @error('amount') is-invalid @enderror" value="{{ old('amount') }}" name="amount" placeholder="0.00" />

        </div>

        <div class="form-group">
            <label class="form-label mb-3">@lang('Recipient\'s Username or Email')</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" class="form-control username @error('recipient') is-invalid @enderror" id="recipient"
                name="recipient" value="{{ old('recipient') }}" placeholder="Beneficiary" />
        </div>
        <div class="form-group">
            <label class="form-label mb-3" data-kt-translate="two-step-label">@lang('Transaction Pin')</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" class="form-control username @error('pin') is-invalid @enderror" id="pin" name="pin" value="{{ old('pin') }}" placeholder="****" />
        </div>


        <button type="submit" class="btn theme-btn w-100" data-bs-toggle="modal">Transfer</button>
      </form>
    </div>
  </section>
  <!-- Withdraw section end -->



@endsection
