@extends($activeTemplate . 'layouts.dashboard')
@section('panel')



<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
      @forelse(@$log as $item)
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail{{$item->id}}" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="categories-icon" data-feather="gift"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{$general->cur_sym}}{{showAmount($item->amount) }}</h5>
                <h3 class="@if ($item->status == 1) success-color @else error-color @endif"> @if($item->status == 1) Active @else Used @endif<span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="text-dark">Amount</h5>
                <h5 class="light-text">{{ diffForHumans($item->created_at) }}</h5>
              </div>
            </div>
          </a>
        </div>
      </div>


<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="transaction-detail{{$item->id}}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Voucher Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text">{{ showDateTime($item->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text">{{ diffForHumans($item->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Amount </h3>
            <h3 class="fw-normal light-text">{{ __($general->cur_sym) }}{{ showAmount($item->amount) }}</h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Code</h3>
            <h3 class="fw-normal light-text">
              {{ __($item->code) }}
            </h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Beneficiary</h3>
            <h3 class="fw-normal light-text">
              {{ __(@$item->user->username) }}
            </h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text">
              @if ($item->status == 1)
                                                  <span
                                                      class="badge bg-success">Active</span>
                                              @else
                                                  <span
                                                      class="badge bg-danger">Used</span>
                                             
                                              @endif
          </h3>
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

@push('breadcrumb-plugins')
<a href="{{ route('user.voucher.create') }}" class="back-btn">
  <i class="icon" data-feather="x"></i>
</a>
@endpush
@stop 
                             
                      


