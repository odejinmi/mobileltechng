@extends($activeTemplate . 'layouts.dashboard')
@section('panel')



  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/loan1.png')}}" alt="banner2" />
            </a>
          </div> 
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/loan2.png')}}" alt="banner2" />
            </a>
          </div> 

          
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->

  <!-- pay-successfully section starts -->
  @if(session()->has('done'))

  <section class="section-b-space">
    <div class="custom-container">
      <div class="successfully-pay">
        <img class="img-fluid pay-img" src="{{ asset($activeTemplateTrue . 'mobile/images/gif/successfull-payment.gif')}}" alt="Payment" />
      </div> 
    </div>
  </section>
  <!-- pay-successfully section end -->
  @else
  <!-- pay money section starts -->
  <section class="pay-money section-b-space">
    <div class="custom-container">
        <form action="{{ route('user.loan.apply') }}" method="post"> 
        @csrf 

      <div class="profile-pic">
        <img class="img-fluid img" src="{{ asset('assets/assets/dist/images/backgrounds/2.png')}}" alt="p3" />
      </div> 
      <h3 class="person-name">Paying money to {{auth()->user()->fullname}}</h3>
      <h5 class="upi-id">APP ID : {{auth()->user()->username}}</h5>
     

      <ul class="card-list">
        @forelse ($plans as $plan)
        <li class="payment-add-box mb-1">
          <div class="add-img">
            <i class="icon text-primary" data-feather="gift"></i>
          </div>
          <div class="add-content">
            <div>
              <h5 class="fw-semibold dark-text">{{ __(@$plan->name) }}</h5>
              <h6 class="mt-2 light-text">{{ __($general->cur_sym) }}{{ __(showAmount($plan->minimum_amount)) }} - {{ __($general->cur_sym) }}{{ __(showAmount($plan->maximum_amount)) }}</h6>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="{{$plan->id}}" name="plan" />
            </div>
          </div>
        </li>
        @empty
        {!!emptyData()!!}
        @endforelse
      </ul>
      <div class="form-group">
        <div class="form-input mt-4">
          <input type="number" class="form-control" name="amount"  id="inputamount" placeholder="0.00" />
        </div>
      </div>
      <div class="form-group">
        <div class="form-input mt-3">
          <input type="text" class="form-control reason" name="reason" id="inputreason" placeholder="Enter reason" />
        </div>
      </div>

      <button type="submit" class="btn theme-btn w-100">Request</button>
    </form>
    </div>
  </section>
  @endif
  <!-- pay money section end -->

@endsection

@push('breadcrumb-plugins')
<a href="{{ route('user.loan.list') }}" class="back-btn">
    <i class="icon" data-feather="printer"></i>
  </a>
@endpush

 