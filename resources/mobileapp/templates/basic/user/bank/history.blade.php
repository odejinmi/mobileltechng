@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<!-- person transaction list section starts -->
<section class="section-b-space">
    <div class="custom-container"> 
  
      <div class="row gy-3">
        @forelse(@$transactions as $deposit)
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail{{$deposit->id}}" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <i class="icon" data-feather="printer"></i>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{ __($deposit->trx) }}</h5>
                  <h3 class="success-color"> {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }}<span></span></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text">{{$deposit->remark}}</h5>
                  <h5 class="light-text">{{ diffForHumans($deposit->created_at) }}</h5>
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
          <h2 class="modal-title">Payout Detail</h2>
        </div>
        <div class="modal-body">
          <ul class="details-list">
            <li>
              <h3 class="fw-normal dark-text">Payout status</h3>
              <h3 class="fw-normal light-text"><label class='badge bg-success'> Sent</label></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Date</h3>
              <h3 class="fw-normal light-text">1{{ showDateTime($deposit->created_at) }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Time</h3>
              <h3 class="fw-normal light-text">{{ diffForHumans($deposit->created_at) }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Bank </h3>
              <h3 class="fw-normal light-text">{{ @$deposit->val_1->bank }}</h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Name</h3>
              <h3 class="fw-normal light-text">{{ @$deposit->val_1->account_name }}</h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Nuban</h3>
              <h3 class="fw-normal light-text">{{ @$deposit->val_1->account_number }}</h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Narration</h3>
              <h3 class="fw-normal light-text">{{ __($deposit->remark) }}</h3>
            </li> 
            <li class="amount">
              <h3 class="fw-normal dark-text">Amount</h3>
              <h3 class="fw-semibold error-color">{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</h3>
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
      @if ($transactions->hasPages())
      <div class="card-footer">
          {{ $transactions->links() }}
      </div>
      @endif
       
    </div>
  </section>
  <!-- person transaction list section end -->
 
  
@endsection
 
@push('breadcrumb-plugins')
<a href="{{ route('user.bank.transfer.start') }}" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush
