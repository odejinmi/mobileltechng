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
                <div class="categories-box">
                  <i class="categories-icon @if($deposit->status == 1) text-success @elseif($deposit->status == 0) text-info @elseif($deposit->status == 2)  text-warning @else  text-danger @endif" data-feather="file-text"></i>
                </div>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{ __(@$deposit->account->name) }}</h5>
                  <h3 class="@if($deposit->status == 1) text-success @elseif($deposit->status == 0) text-info @elseif($deposit->status == 2)  text-warning @else  text-danger @endif"> {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }}</h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text">{{ __($deposit->details) }}</h5>
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
                                      <h2 class="modal-title">Transaction Detail</h2>
                                      </div>
                                      <div class="modal-body">
                                      <ul class="details-list">
                                          <li>
                                          <h3 class="fw-normal dark-text">Status</h3>
                                          <h3 class="fw-normal light-text"> <label class='badge @if($deposit->status == 1) bg-success @elseif($deposit->status == 0)  bg-dark text-white @elseif($deposit->status == 2)  bg-warning @else  bg-danger @endif'> @if($deposit->status == 1) Successful @elseif($deposit->status == 2) Pending Approval @elseif($deposit->status == 0) Unpaid @elseif($deposit->status == 3) Canceled @else Declined @endif</label></h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Date</h3>
                                          <h3 class="fw-normal light-text">{{ showDateTime($deposit->created_at) }}</h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Account</h3>
                                          <h3 class="fw-normal light-text">{{ __(@$deposit->account->name) }}</h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Beneficiary</h3>
                                          <h3 class="fw-normal light-text">{{ __($deposit->details) }}</h3>
                                          </li>
                                          <li>
                                          <h3 class="fw-normal dark-text">Amount</h3>
                                          <h3 class="fw-normal light-text">{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</h3>
                                          </li> 
                                          @if($deposit->status == 0) 
                                           <a href="{{route('user.requestaccount.confirm',encrypt($deposit->trx))}}" class="btn theme-btn w-100">Make Payment</a>
                                          <a href="{{route('user.requestaccount.cancel',encrypt($deposit->trx))}}" class="btn theme-btn w-100 bg-danger">Cancel Request</a>
                                          @endif
                                      </ul>
                                      </div>
                                      <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                                      <i class="icon" data-feather="x"></i>
                                      </button>
                                  </div>
                                  </div>
                              </div>
        @empty
        {!!emptyData2()!!}
        @endforelse
         
      </div>

      
    </div>
  </section>
  <!-- person transaction list section end -->
  
@endsection
  