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
              <img src="{{ url('/') }}/assets/images/coins/{{$deposit->asset->image}}" width="30" class="path1"/>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ __($deposit->deposit_code) }}</h5>
                <h3 class="@if($deposit->status == 'success') success-color @else error-color @endif"> ${{ showAmount($deposit->payment) }}<span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">{{ __($general->cur_sym) }}{{ showAmount($deposit->value) }}</h5>
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
        <h2 class="modal-title">Trade Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text"><label class='badge text-white  @if($deposit->status == 'success') bg-success @else bg-danger @endif'> @php echo $deposit->status @endphp</label></h3>
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
            <h3 class="fw-normal dark-text">Asset </h3>
            <h3 class="fw-normal light-text">{{ __($deposit->product_name) }}</h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Symbol</h3>
            <h3 class="fw-normal light-text">{{ __($deposit->asset->symbol) }}</h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Rate</h3>
            <h3 class="fw-semibold @if($deposit->status == 'success') success-color @else error-color @endif">{{ showAmount($deposit->price) }} {{ __($general->cur_text) }}</h3>
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
    <br>
    <nav aria-label="Page navigation example mt-4">
      <ul class="pagination justify-content-center">
          {{ $log->links() }}
      </ul>
  </nav> 
    @endif
     
  </div>
</section>

  
@endsection
 

@push('breadcrumb-plugins')
<a href="{{route('user.crypto.buy')}}" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush