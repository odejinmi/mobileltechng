@extends($activeTemplate . 'layouts.dashboard')
@section('panel') 
<section class="section-b-space">
    <div class="custom-container"> 
  
      <div class="row gy-3">
        @forelse(@$transactions as $trx)
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail{{$trx->id}}" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <i class="icon" data-feather="printer"></i>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{ __($trx->trx) }}</h5>
                  <h3 class="@if ($trx->trx_type == '+') success-color @else error-color @endif"> {{ __($general->cur_sym) }}{{ showAmount($trx->amount) }}<span></span></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="@if ($trx->trx_type == '+') success-color @else error-color @endif">@if ($trx->trx_type == '+') Credit @else Debit @endif</h5>
                  <h5 class="light-text">{{ diffForHumans($trx->created_at) }}</h5>
                </div>
              </div>
            </a>
          </div>
        </div>
  
  
  <!-- transaction detail modal start -->
  <div class="modal successful-modal transfer-details fade" id="transaction-detail{{$trx->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Transaction Detail</h2>
        </div>
        <div class="modal-body">
          <ul class="details-list">
            
            <li>
              <h3 class="fw-normal dark-text">Date</h3>
              <h3 class="fw-normal light-text">{{ showDateTime($trx->created_at) }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Time</h3>
              <h3 class="fw-normal light-text">{{ diffForHumans($trx->created_at) }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Amount </h3>
              <h3 class="fw-normal light-text">{{ __($general->cur_sym) }}{{ showAmount($trx->amount) }}</h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Fee</h3>
              <h3 class="fw-normal light-text">{{ __($general->cur_sym) }}{{ showAmount($trx->charge) }}</h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Balance Before</h3>
              <h3 class="fw-normal light-text">
                {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
              </h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Remark</h3>
              <h3 class="fw-normal light-text">{{ __($trx->details) }}</h3>
            </li>   
            @if($trx->remark == 'POS')
            <li>
              <h3 class="fw-normal dark-text"></h3>
              <h3 class="fw-normal light-text"><a href="?action=print&id={{$trx->trx}}" class="badge bg-primary">Print Receipt</a></h3>
            </li>  
            @endif
             
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
      <br>
      <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            {{ $transactions->links() }}
        </ul>
    </nav> 
      @endif
    </div>
  </section>
  
  @push('style')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  @endpush
  @push('script')
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script>
    $(function() {
      $('input[name="date"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        document.getElementById("start").value = start.format('YYYY-MM-DD');
        document.getElementById("end").value = end.format('YYYY-MM-DD');
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
    </script>
@endpush    
  @push('breadcrumb-plugins')

   <div class="dropdown">
    <a href="#form" class="btn theme-btn" data-bs-toggle="modal">
         <i class="icon" data-feather="printer"></i>
     </a>

  </div>
  @endpush
      <!-- form modal starts -->
      <div class="modal add-money-modal fade" id="form" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Generate Statement Of Account</h2>
                </div>
                <div class="modal-body">
                  <form action="">
                    <div class=" ">
                         <div class="form-group">
                          <label>@lang('Transaction Type')</label>
                            <select class="form-control" name="trx_type">
                                <option value="">@lang('All')</option>
                                <option value="+" @selected(request()->trx_type == '+')>@lang('Credit')</option>
                                <option value="-" @selected(request()->trx_type == '-')>@lang('Debit')</option>
                            </select>
                        </div> 
                        <div class="form-group">
                          <label>@lang('Date')</label>
                            <input class="datepicker-here form-control" name="date" type="text" value="{{ request()->date }}" placeholder="@lang('Start date - End date')" autocomplete="off">
                            <input name="start" hidden id="start">
                            <input name="end" hidden id="end">

                        </div>
                        <div class="form-group">
                          <button class="btn theme-btn successfully w-100"><i class="ti ti-search"></i>
                                @lang('Filter')</button>
                        </div>
                    </div>
                </form>

                 </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <i class="icon" data-feather="x"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- form modal end -->

@endsection  
