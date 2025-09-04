@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

<!-- person transaction list section starts -->
<section>
  <div class="custom-container">
    <div class="crypto-wallet-box">
      <div class="card-details">
        <div class="d-block w-75">
          <h5 class="fw-semibold">@lang('Invoice Amount')</h5>
          <h2 class="mt-2">{{ showAmount($invoice->amount) }} {{ __($general->cur_text) }}</h2>
        </div> 
      </div>
    </div>
  </div>
</section>
<section>
  <div class="custom-container">
    <div class="crypto-wallet-box">
      <div class="card-details">
        <div class="d-block w-75">
          <h5 class="fw-semibold">@lang('Total Payment')</h5>
          <h2 class="mt-2">{{ showAmount($invoicetotal) }} {{ __($general->cur_text) }}</h2>
        </div> 
      </div>
    </div>
  </div>
</section>
<!-- card end -->

<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">

      <div>
        <label>@lang('Invoice Link')</label>
        <div class="input-group d-nones">
          <input type="text"id="referralURL" value="{{ url('/') }}/user/invoice/pay/{{($invoice->trx)}}" readonly class="form-control"  onclick="myFunction()" > 
      </div>
      <hr>
      @forelse(@$log as $data)
      @php
      $deposit = App\Models\Deposit::whereTrx($data->trx)->first();
      @endphp
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail{{$deposit->id}}" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ showDate($data->created_at) }}</h5>
                <h3 class="@if($deposit->status == 1) success-color @else  error-color @endif"> {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }}<span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">Payment</h5>
                <h5 class="light-text">{{ showTime($deposit->created_at) }}</h5>
              </div>
            </div>
          </a>
        </div>
      </div>


<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="transaction-detail{{$deposit->id}}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Invoice Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          
          <li>
            <h3 class="fw-normal dark-text">Name</h3>
            <h3 class="fw-normal light-text">{{ __(explode("|", $deposit->val_1)[0]) }} {{ __(explode("|", $deposit->val_1)[1]) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Email</h3>
            <h3 class="fw-normal light-text">{{ __(explode("|", $deposit->val_1)[2]) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Phone</h3>
            <h3 class="fw-normal light-text">{{ __(explode("|", $deposit->val_1)[3]) }}</h3>
          </li> 
          <li class="amount">
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-semibold error-color">{{ showAmount($data->amount) }} {{ __($general->cur_text) }}</h3>
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

      @empty
          {!!emptyData2()!!}
      @endforelse
    </div>

     
  </div>
</section>
<!-- person transaction list section end -->
 

@endsection
@push('script')
 <script>
  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            SlimNotifierJs.notification('success', 'Invoice Link Copied');

        }
 </script>
@endpush
