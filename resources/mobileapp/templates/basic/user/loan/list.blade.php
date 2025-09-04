@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<!-- person transaction list section starts -->
<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
      @forelse(@$loans as $loan)
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail{{$loan->id}}" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ __($loan->loan_number) }}</h5>
                <h3 class="success-color"> {{ __($general->cur_sym) }}{{ showAmount($loan->payment) }}<span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">More..</h5>
                <h5 class="light-text">{{ diffForHumans($loan->created_at) }}</h5>
              </div>
            </div>
          </a>
        </div>
      </div>


<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="transaction-detail{{$loan->id}}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Loan Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text">@php echo $loan->statusBadge; @endphp</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text">1{{ showDateTime($loan->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text">{{ diffForHumans($loan->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Plan </h3>
            <h3 class="fw-normal light-text">{{ __($loan->plan->name) }}</h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Installment </h3>
            <h3 class="fw-normal light-text">@lang('Every') {{ __($loan->installment_interval) }} @lang('Days')</h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Next Installment </h3>
            <h3 class="fw-normal light-text"> @if ($loan->nextInstallment)
                                                    {{ showDateTime($loan->nextInstallment->installment_date, 'd M, Y') }}
                                                @endif
            </h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-normal light-text">{{ __($general->cur_text) }} {{ showAmount($loan->amount) }}</h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Payable Amount</h3>
            <h3 class="fw-semibold error-color"> {{ $general->cur_sym . showAmount($loan->payable_amount) }}</h3>
          </li>
          <li class="amount">
            <h3 class="fw-normal dark-text"></h3>
            <h3 class="fw-semibold success-color" onclick="redirect('{{ route('user.loan.instalment.logs', $loan->loan_number) }}')">View</h3>
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
    @if ($loans->hasPages())
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          {{ $loans->links() }}
      </ul>
  </nav> 
    @endif
     
  </div>
  @push('script')
  <script>
    function redirect(url)
    {
        window.location.href = url;
    }
  </script>
  @endpush
</section>
@endsection
<!-- person transaction list section end -->