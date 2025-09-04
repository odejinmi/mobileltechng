@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
        @forelse($card as $k=>$data)
        @php
            $gcard = App\Models\Giftcard::whereId($data->card_id)->first();
        @endphp
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail{{$data->id}}" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
                <img width="50" src="{{ asset('assets/images/giftcards') }}/{{ @$gcard->image }}" alt="avatar">
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ @$gcard->name }}<br>
                  <small class="text-muted">{{strToUpper($data->trx_type)}}</small>
                </h5>
                
                @if ($data->status == 1)
                <span
                    class="badge bg-success">{{ $data->country }}{{ $data->amount }}</span>
                @elseif($data->status == 0)
                    <span
                        class="badge bg-warning">{{ $data->country }}{{ $data->amount }}</span>
                @elseif($data->status == 2)
                    <span
                        class="badge bg-danger">{{ $data->country }}{{ $data->amount }}</span>
                @endif  
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">{{$data->remark}}</h5>
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
        <h2 class="modal-title">Trade Details</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text">
                @if ($data->status == 1)
                <span
                    class="badge bg-success">Approved</span>
                @elseif($data->status == 0)
                    <span
                        class="badge bg-warning">Pending</span>
                @elseif($data->status == 2)
                    <span
                        class="badge bg-danger">Declined</span>
                @endif    
            </h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text">1{{ showDateTime($data->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text">{{ diffForHumans($data->created_at) }}</h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Giftcard</h3>
            <h3 class="fw-normal light-text">{{ isset(App\Models\Giftcard::whereId($data->card_id)->first()->id) ? App\Models\Giftcard::whereId($data->card_id)->first()->name : 'N/A' }}</h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Giftcard Type</h3>
            <h3 class="fw-normal light-text">{{ isset(App\Models\Giftcardtype::whereId($data->currency)->first()->id) ? App\Models\Giftcardtype::whereId($data->currency)->first()->name : 'N/A' }}</h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Exchange Rate</h3>
            <h3 class="fw-normal light-text">1{{ $data->country }} = {{ $general->cur_sym }}{{ number_format($data->rate, 2) }}</h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Calculated Value</h3>
            <h3 class="fw-normal light-text">{{ $general->cur_sym }}{{ number_format($data->amount * $data->rate, 2) }}</h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Card Type</h3>
            <h3 class="fw-semibold error-color">{{ $data->type }}</h3>
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
    @if ($card->hasPages())
    <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            {{ $card->links() }}
        </ul>
    </nav> 
    @endif
     
  </div>
</section>
  
@endsection
 
