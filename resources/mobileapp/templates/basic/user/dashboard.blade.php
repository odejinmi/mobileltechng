@extends($activeTemplate . 'layouts.dashboard')
@section('panel')


  <!-- card start -->

  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
          <a href="{{route('user.downlines')}}">
             <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/domore.png')}}" alt="banner2" />
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/refer.png')}}" alt="banner1" />
            </a>
          </div>


        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->

  <section class="section-b-space">
    <div class="custom-container">
      <div class="card-box">
        <div class="card-details" style="background-color:#30003D;">
          <div class="d-flex justify-content-between">
            <h5 class="fw-semibold">Main Wallet</h5>
            <img src="{{ asset($activeTemplateTrue . 'mobile/images/svg/ellipse.svg')}}" alt="ellipse" />
          </div>

          <h1 class="mt-2 text-white">{{ $general->cur_sym }}{{ showAmount($widget['balance']) }}</h1>

          <div class="amount-details">
            <div class="amount w-50 text-start">
              <div class="d-flex align-items-center justify-content-start">
                <h5>@lang('Deposits')</h5>
              </div>
              <h3 class="text-white">{{ $general->cur_sym }}{{ showAmount($widget['deposit']) }}</h3>
            </div>
            <div class="amount w-50 text-end border-0">
              <div class="d-flex align-items-center justify-content-end">
                <h5>@lang('Payouts')</h5>
              </div>
              <h3 class="text-white">{{ $general->cur_sym }}{{ showAmount($widget['payout']) }}</h3>
            </div>
          </div>
        </div>
        <a href="{{ route('user.deposit.index') }}" class="add-money theme-color">+ Fund Wallet</a>
      </div>
    </div>
  </section>
  <!-- card end -->

  <!-- categories section starts -->
  <section class="categories-section section-b-space">
    <div class="custom-container">
      <ul class="categories-list">
        @if ($general->p2p > 0)
        <li>
          <a href="{{ route('user.p2p') }}">
            <div class="categories-box">
              <i class="categories-icon" data-feather="repeat"></i>
            </div>
            <h5 class="mt-2 text-center">P2P</h5>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('user.invoice.create') }}">
            <div class="categories-box">
              <i class="categories-icon" data-feather="file-text"></i>
            </div>
            <h5 class="mt-2 text-center">Invoice</h5>
          </a>
        </li>
        @if($general->request_account > 0)
        <li>
          <a href="{{ route('user.requestaccount.create') }}">
            <div class="categories-box">
              <i class="categories-icon icon1" data-feather="log-in"></i>
            </div>
            <h5 class="mt-2 text-center">Request</h5>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('user.bank.transfer.start') }}">
            <div class="categories-box">
              <i class="iconsax categories-icon" data-icon="bank"></i>
            </div>
            <h5 class="mt-2 text-center">Transfer</h5>
          </a>
        </li>
      </ul>
    </div>
  </section>
  <!-- categories section end -->

  <!-- service section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Bills Payment</h2>
      </div>
      <div class="row gy-3">
        <div class="col-3">
          <a href="{{ route('user.buy.local.utility') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="activity"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Electricity</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{ route('user.buy.internet_sme') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="wifi"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Internet</h5>
          </a>
        </div>

        <div class="col-3">
          <a href="{{ route('user.buy.cabletv') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="monitor"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Cable TV</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{ route('user.airtime.indexlocal') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="tablet"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Airtime</h5>
          </a>
        </div>

        <div class="col-3">
          <a href="{{ route('user.airtime.tocash.request') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="star"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Airtime 2 Cash</h5>
          </a>
        </div>
        @if($general->voucher)
        <div class="col-3">
          <a href="{{ route('user.voucher.create') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="file-plus"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Voucher</h5>
          </a>
        </div>
        @endif

        @if ($general->insurance > 0)
        <div class="col-3">
          <a href="{{ route('user.buy.insurance') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="umbrella"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Insurance</h5>
          </a>
        </div>
        @endif

          @if ($general->education > 0)
        <div class="col-3">
          <a href="{{ route('user.buy.education') }}">
            <div class="service-box">
              <i class="iconsax categories-icon" data-feather="book"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Education</h5>
          </a>
        </div>
        @endif
      </div>
    </div>
  </section>
  <!-- service section end -->

  <!-- Transaction section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Transaction</h2>
        <a href="{{ route('user.transactions') }}">See all</a>
      </div>

      <div class="row gy-3">
        @forelse($trx as $data)
        <div class="col-12">
          <div class="transaction-box">
            <a href="#" class="d-flex gap-3">
              <div class="transaction-image">
                <div class="categories-box">
                    <i class="categories-icon icon @if($data->trx_type == '+') text-success @else text-danger @endif" @if($data->trx_type == '+') data-feather="download" @else  data-feather="upload" @endif></i>
                </div>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{$data->remark}}</h5>
                  <h3 class="@if($data->trx_type == '+') success-color @else error-color @endif">{{ $general->cur_sym }}{{ showAmount($data->amount) }}</h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"></h5>
                  <h5 class="light-text"> {{ diffForHumans($data->created_at) }}</h5>
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

  <!-- all cards section starts -->
  @if($general->virtualcard > 0)
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>My Cards</h2>
        <a href="{{ route('user.virtualcard.index') }}">Add New</a>
      </div>

      <div class="swiper card-slider">
        <div class="swiper-wrapper">
          @forelse($cards as $data)
          <div class="swiper-slide">
            <div class="credit-card-box color1">
              <div class="card-logo">
                <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="logo1" />
                @if ($data->status == 'active')
                <span class="badge bg-success badge-sm">{{ strToUpper($data->status) }}</span>
                @else
                <span class="badge bg-warning badge-sm">{{ strToUpper($data->status) }}</span>
                @endif
              </div>

              <h6 class="card-number">{{$data->pan}}</h6>
              <h5 class="card-name">{{Auth::user()->fullname}}</h5>
              <h2 class="card-amount">@if($data->currency == 'NGN')₦ @else $ @endif ****</h2>
              <div class="d-block">
                <div class="card-date w-100">
                  <h6>Exp. date</h6>
                  <h6>Cvv</h6>
                </div>
                <div class="card-numbers w-100">
                  <h6 class="text-white fw-semibold mt-1">{{$data->expiry_month}} /{{$data->expiry_year}}</h6>
                  <a href="{{route('user.virtualcard.details',$data->card_id)}}">
                  <h5 class="text-white fw-semibold mt-1">
                        ***
                  </h5>
                  </a>
                </div>
              </div>
            </div>
          </div>
          @empty
          {!!emptyData2()!!}
          @endforelse

      </div>
    </div>
  </section>
  @endif
  <!-- all cards section end -->


  <!-- monthly statistics section starts -->
  <section>
    <div class="custom-container">
      <div class="statistics-banner" style="background-color:#30003D;">
        <div class="d-flex justify-content-center gap-3">
          <div class="statistics-image">
            <i class="icon" data-feather="bar-chart-2"></i>
          </div>
          <div class="statistics-content d-block">
            <h5>Monthly Statistics</h5>
            <h6>30% better performance than previous</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- monthly statistics section end -->



@endsection

@push('breadcrumb-plugins')
<a href="{{ route('ticket.index') }}" class="back-btn">
    <i class="icon" data-feather="bell"></i>
  </a>
@endpush
