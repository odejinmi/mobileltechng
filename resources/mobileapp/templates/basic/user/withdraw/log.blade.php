@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<section class="section-b-space">
    <div class="custom-container"> 
  
      <div class="row gy-3">
        @forelse(@$withdraws as $data)
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail{{$data->id}}" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <i class="icon" data-feather="printer"></i>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{ __($data->trx) }}</h5>
                  <h3 class="@if ($data->status == Status::PAYMENT_SUCCESS) success-color @else error-color @endif"> {{ __($general->cur_sym) }}{{ showAmount($data->amount) }}<span></span></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text">{{ __($data->method?->name) }}</h5>
                  <h5 class="light-text">{{ diffForHumans($data->created_at) }}</h5>
                </div>
              </div>
            </a>
          </div>
        </div>
  
  
  <!-- transaction detail modal start -->
  <div class="modal successful-modal transfer-details fade" id="transaction-detail{{$data->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Request Detail</h2>
        </div>
        <div class="modal-body">
          <ul class="details-list">
            <li>
              <h3 class="fw-normal dark-text">Status</h3>
              <h3 class="fw-normal light-text">
                @if ($data->status == 2)
                <span class="badge bg-warning">@lang('Pending')</span>
            @elseif($data->status == 1)
                <span class="badge bg-success">@lang('Completed')</span>
                <button class="btn btn-info btn-rounded  badge approveBtn"
                    data-admin_feedback="{{ $data->admin_feedback }}"><i
                        class="fa fa-info"></i></button>
            @elseif($data->status == 3)
                <span class="badge bg-danger">@lang('Rejected')</span>
                <button class="btn btn-info btn-rounded badge approveBtn"
                    data-admin_feedback="{{ $data->admin_feedback }}"><i
                        class="fa fa-info"></i></button>
            @endif
              </h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Date</h3>
              <h3 class="fw-normal light-text">{{ showDateTime($data->created_at) }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Time</h3>
              <h3 class="fw-normal light-text">{{ diffForHumans($data->created_at) }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Amount </h3>
              <h3 class="fw-normal light-text">{{ __($general->cur_sym) }}{{ showAmount($data->amount) }}</h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Fee</h3>
              <h3 class="fw-normal light-text">{{ __($general->cur_sym) }}{{ showAmount($data->charge) }}</h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Rate</h3>
              <h3 class="fw-normal light-text">
                1 {{ __($general->cur_text) }} = {{ showAmount($data->rate) }} {{ __($data->currency) }}
              </h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Final Amount</h3>
              <h3 class="fw-normal light-text">{{ showAmount($data->final_amount) }}
                {{ __($data->method_currency) }}</h3>
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
      @if ($withdraws->hasPages())
      <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            {{ $withdraws->links() }}
        </ul>
    </nav> 
      @endif
       
    </div>
  </section>
  
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('user.withdraw') }}" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush 
