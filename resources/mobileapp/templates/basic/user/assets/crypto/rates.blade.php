@extends($activeTemplate . 'layouts.dashboard')
@section('panel')


  <!-- Buy & Sell history section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Our Rate</h2>
        <a href="#"></a>
      </div>

      <div class="row gy-3">
        @forelse($coins as $data)
        <div class="col-12">
          <div class="transaction-box">
            <a href="#" class="d-flex gap-3">
              <div class="transaction-imagse color1">
                <img class="img-fluids icons" src="{{ url('/') }}/assets/images/coins/{{@$data->image}}" width="40" alt="bitcoins" />
                
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{$data->name}}</h5>
                  <h5 class="error-color"><small>Sell </small>{{$general->cur_sym}}{{number_format($data->sell_rate,2)}}</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text">{{$data->symbol}}</h5>
                  <h5 class="success-color"><small>Buy </small>{{$general->cur_sym}}{{number_format($data->buy_rate,2)}}<span class="light-text"></span></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        @empty
        {!!emptyData2()!!}
        @endforelse 
      </div>
    </div>
  </section>
  <!-- Transaction section end -->
@stop