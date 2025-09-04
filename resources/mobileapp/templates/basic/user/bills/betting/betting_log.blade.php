@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<!-- person transaction list section starts -->
<section class="section-b-space">
  <div class="custom-container"> 

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
                <h5>{{ __($deposit->product_name) }}</h5>
                <h3 class=" @if($deposit->status == 'success') success-color @else error-color @endif"> {{ __($general->cur_sym) }}{{ showAmount($deposit->payment) }}<span></span></h3>
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
        <h2 class="modal-title">Funding Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text"><label class='badge @if($deposit->status == 'success') bg-success  @else  bg-danger @endif'>@php echo $deposit->status @endphp</label></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text">{{ showDateTime($deposit->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text">{{ diffForHumans($deposit->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Customer </h3>
            <h3 class="fw-normal light-text">{{ __($deposit->val_1) }}</h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Number</h3>
            <h3 class="fw-normal light-text">{{ @$deposit->val_2 }}</h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-semibold error-color">{{ __($general->cur_text) }} {{ showAmount($deposit->payment / $deposit->quantity) }}</h3>
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
    @if ($log->hasPages())
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          {{ $log->links() }}
      </ul>
  </nav> 
    @endif
     
  </div>
</section>
@endsection
<!-- person transaction list section end -->
 

@push('breadcrumb-plugins')
<a href="{{ route('user.fund.betting.wallet') }}" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush