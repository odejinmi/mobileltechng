@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<!-- person transaction list section starts -->
<section class="section-b-space">
  <div class="custom-container">
    <div class="title">
      <h2>Today</h2>
    </div>

    <div class="row gy-3">
      @forelse(@$log as $deposit)
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail{{$deposit->id}}" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ __($deposit->trx) }}</h5>
                <h3 class="@if($deposit->status == 1) success-color @else  error-color @endif"> {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }}<span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">Invoice</h5>
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
        <h2 class="modal-title">Invoice Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Invoice status</h3>
            <h3 class="fw-normal light-text"><label class='badge @if($deposit->status == 1) bg-success @else  bg-danger @endif'> @if($deposit->status == 1) Active @else Inactive @endif</label></h3>
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
            <h3 class="fw-normal dark-text">Purpose</h3>
            <h3 class="fw-normal light-text">{{ __($deposit->purpose) }}</h3>
          </li> 
          <li class="amount">
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-semibold error-color">{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</h3>
          </li>
        </ul>
      </div>
      <a href="{{route('user.invoice',$deposit->trx)}}" class="btn close-btn" >
        <i class="icon" data-feather="link"></i>
      </a>
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
 
@push('breadcrumb-plugins')
<a href="{{ route('user.invoice.create') }}" class="back-btn">
  <i class="icon" data-feather="x"></i>
</a>
@endpush