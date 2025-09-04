@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- monthly statistics section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/5252151.jpg')}}" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/5252151.jpg')}}" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
     
    </div>
    </div>
  </section>
  <a href="{{ route('user.sellgift') }}">
  <section>
    <div class="custom-container">
      <div class="statistics-banner">
        <div class="d-flex justify-content-center gap-3">
          <div class="statistics-image">
            <i class="icon" data-feather="gift"></i>
          </div>
          <div class="statistics-content d-block">
            <h5>Sell Giftcards</h5> 
            <h6>To sell giftcard please click here</h6> 
          </div>
        </div>
      </div>
    </div>
  </section>
</a>
{{--
<a href="{{ route('user.buygift') }}">
  <section>
    <div class="custom-container">
      <div class="statistics-banner">
        <div class="d-flex justify-content-center gap-3">
          <div class="statistics-image">
            <i class="icon" data-feather="shopping-cart"></i>
          </div>
          <div class="statistics-content d-block">
            <h5>Buy Giftcards</h5> 
                <h6>To buy giftcard please click here</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
</a>
--}}
  <!-- monthly statistics section end -->


  <!-- bill details section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Recent Trades</h2>
        <a href="{{ route('user.giftcard.log') }}" >See All</a>
      </div>
      <div class="row g-3">
        @forelse($log as $data)
        @php
            $gcard = App\Models\Giftcard::whereId($data->card_id)->first();
        @endphp
        <div class="col-md-3 col-6">
          <div class="bill-box">
            <div class="d-flex gap-3">
              <div class="bill-icon">
                <img class="img-fluid icon" src="{{ asset('assets/images/giftcards') }}/{{ @$gcard->image }}" alt="p6" />
              </div>
              <div class="bill-details">
                <h5 class="dark-text">{{ @$gcard->name }}</h5>
                <h6 class="light-text mt-2">{{ Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}</h6>
              </div>
            </div>
            <div class="bill-price">
              <h5>{{ $data->country }}{{ $data->amount }}</h5>
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
                    
            </div>
          </div>
        </div>
        @empty
        {!!emptyData2()!!}
        @endforelse
         
    
      </div>
    </div>
  </section>
  <!-- bill details section starts -->

  <!-- news-update section starts -->
  
    @endsection 