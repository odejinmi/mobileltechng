@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

   <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/sellcrypto.png')}}" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/buycrypto.png')}}" style="height:100%;" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
     
    </div>
    </div>
  </section>
  <!-- banner section end -->
   
  <!-- categories section starts -->
  <section class="categories-section section-b-space">
    <div class="custom-container">
      <ul class="categories-list">
        <li>
          <a href="{{ route('user.crypto.buy') }}">
            <div class="categories-box">
              <i class="categories-icon" data-feather="shopping-cart"></i>
            </div>
            <h5 class="mt-2 text-center">Buy</h5>
          </a>
        </li>
        <li>
          <a href="{{ route('user.crypto.sell') }}">
            <div class="categories-box">
              <i class="categories-icon" data-feather="shopping-bag"></i>
            </div>
            <h5 class="mt-2 text-center">Sell</h5>
          </a>
        </li>
        <li>
          <a href="{{ route('user.crypto.rates') }}">
            <div class="categories-box">
              <i class="categories-icon" data-feather="bar-chart-2"></i>
            </div>
            <h5 class="mt-2 text-center">Rate</h5>
          </a>
        </li>

        <li>
          <a href="{{ route('user.crypto.index') }}">
            <div class="categories-box">
              <i class="iconsax categories-icon" data-icon="bank"></i>
            </div>
            <h5 class="mt-2 text-center">Wallet</h5>
          </a>
        </li>
      </ul>
    </div>
  </section>
  <!-- categories section end -->

   

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
  
    @endsection
 
