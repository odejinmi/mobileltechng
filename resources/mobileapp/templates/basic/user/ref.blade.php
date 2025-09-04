@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="{{route('user.downlines')}}">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')}}" alt="banner2" />
            </a>
          </div> 
          <div class="swiper-slide">
            <a href="{{route('user.downlines')}}">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')}}" alt="banner2" />
            </a>
          </div> 

          
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->
  <!-- search section starts -->
  <section>
    <div class="custom-container">
      <form class="theme-form search-head" target="_blank">
        <div class="form-group">
          <div class="form-input">
            <input type="text" onclick="myFunction()"  readonly class="form-control search" value="{{ route('user.register', Auth::user()->username) }}" id="referralURL" placeholder="Search here..." />
            <i class="search-icon" data-feather="copy"></i>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- search section end -->
  <!-- person list starts -->
  <section>
    <div class="custom-container">

      <div class="title">
        <h2>@lang('Referral Downlines')</h2>
      </div>
      <ul class="transfer-list">
        @forelse($ref as $data)
        <li class="w-100">
          <div class="transfer-box">
            <div class="transfer-img">
              <img class="img-fluid icon" src="{{ getImage(getFilePath('userProfile') . '/' . $data->image, getFileSize('userProfile')) }}" alt="p1" />
            </div>
            <div class="transfer-details">
              <div>
                <a href="person-transaction.html">
                  <h5 class="fw-semibold dark-text">{{$data->username}}</h5>
                </a>
                <h6 class="fw-normal light-text mt-2">Joined: {{ diffForHumans($data->created_at) }}</h6>
              </div> 
            </div>
          </div>
        </li>
        @empty
        {!!emptyData2()!!}
        @endforelse
      </ul>
    </div>
  </section>
  <!-- person list end -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="title">
        <h2>@lang('Referral Earnings')</h2>
      </div>

      <div class="row gy-3">
        @forelse($transactions as $data)
        <div class="col-12">
          <div class="transaction-box">
            <a href="transaction-history.html#transaction-detail" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <img class="img-fluid transaction-icon" src="assets/images/svg/1.svg" alt="p1" />
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{$data->remark}}</h5>
                  <h3 class="error-color">{{ __($general->cur_sym) }}{{ showAmount($data->amount) }}</h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text">{{$data->trx}}</h5>
                  <h5 class="light-text">{{ diffForHumans($data->created_at) }}</h5>
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
 
       

    
@endsection
@push('script') 
<script>
   function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            iziToast.success({
                message: 'Link Copied',
                position: "topRight"
            });

        }
</script>
@endpush