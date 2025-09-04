@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- person transaction list section starts -->
  <section class="section-b-space">
    <div class="custom-container"> 

      <div class="row gy-3">
        @forelse($trx as $data)
        <div class="col-12">
          <div class="transaction-box">
            <a href="{{$data['explorer_url']}}" class="d-flex gap-3">
              <div class="transaction-image color1">
                <img class="img-fluid icon" src="{{ url('/') }}/assets/images/coins/{{@$coin->image}}" alt="bitcoins" />
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{$coin->name}}</h5>
                  <h3 class="@if($data['type'] == 'receive') success-color  @else  error-color  @endif">${{number_format($data->usd,2)}}</h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class=" @if($data['type'] == 'receive') success-color  @else  error-color  @endif">{{@strToUpper($data['type'])}}</h5>
                  <h5 class=" @if($data['type'] == 'receive') success-color  @else  error-color  @endif">{{showDate($data['date'])}}</h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        @empty
        {!!emptyData2()!!}
        @endforelse 
      </div>
      @if ($trx->hasPages())
      <br>
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          {{ $trx->links() }}
      </ul>
  </nav> 
    @endif
    </div>
  </section>

@endsection


@push('breadcrumb-plugins')
<a href="#" onclick="history.back()" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush

@push('script') 

@endpush

