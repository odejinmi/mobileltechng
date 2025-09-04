@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

 <!-- content @s
-->
<!-- my account section start -->

  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/banner1.png')}}" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="{{ asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')}}" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Load Voucher</h2>
        <a href="{{ route('user.voucher.history') }}">See all</a>
      </div>
      <div class="row g-3">
        
        <div class="col-md-12 col-12">
          <div class="bill-box">
            <div class="d-flex gap-3">
              <div class="bill-icon">
                <i class="categories-icon" data-feather="gift"></i>
            </div>
              <div class="bill-details">
                <h5 class="dark-text">Have A Voucher?</h5>
                <h6 class="light-text mt-2">Please click here</h6>
              </div>
            </div>
            <div class="bill-price">
              <h5></h5>
              <a href="#load-voucher" data-bs-toggle="modal" class="btn bill-pay bill-paid">Load</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<section class="section-b-space">
    <div class="custom-container">
       
        <form  class="auth-form pt-0 mt-1" novalidate="novalidate" action="" method="post">
            @csrf
            <section class="pay-money section-b-space">
                <div class="form-group">
                    <div class="form-group mt-3">
                        <div class="form-input" id="">
                            <input type="number" name="amount" placeholder="{{$general->cur_sym}}0.00" class="form-control amount"
                                id="amount">
                        </div>
                    </div>
                </div> 
                <center>
                    <ul class="nav nav-pills tab-style3 w-100 mt-3" id="myTab" role="tablist">
                        <li class="nav-item w-25"  onclick="setamount(200)" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{$general->cur_sym}}200</button>
                        </li>
                        <li class="nav-item w-25"  onclick="setamount(500)" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">{{$general->cur_sym}}500</button>
                        </li>
                        <li class="nav-item w-25"  onclick="setamount(1000)" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">{{$general->cur_sym}}1k</button>
                        </li>
                        <li class="nav-item w-25" onclick="setamount(2000)" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">{{$general->cur_sym}}2k</button>
                        </li>
                    </ul>
                 
                @push('script')
                <script>
                    function setamount(amount) {
                        document.getElementById("amount").value = amount; 
                    }
                </script>
               @endpush
                </center>
                <div class="form-group">
                    <div class="form-input mt-3">
                        <input type="number" onkeyup="getvalue(this)" class="form-control reason  unit @error('unit') is-invalid @enderror" id="unit"
                                    name="unit" value="{{ old('unit') }}" placeholder="Enter Units" />
                    </div>
                </div>
               

            </section>
            <small class="" id="value"></small>
        <button type="submit" class="btn theme-btn w-100"  id="submit">Convert</button>
      </form>
    </div>
  </section>
  <!-- my account section end -->
  
  @push('script')
  <script>
      function fixeamount(e)
      {
      document.getElementById("amount").value = e.value;
      document.getElementById("value").innerHTML = ''
      document.getElementById("unit").value = ''
      return;
      }

      function getvalue(e)
      {
      var unit = e.value;
      var amount = document.getElementById("amount").value;
      if(amount < 1)
      {
          SlimNotifierJs.notification('error', 'error', 'Enter and amount first', 3000);
          return;
      }
      var balance = "{{Auth::user()->balance}}";
      var total = unit*amount;
      if(total > balance)
      {
          SlimNotifierJs.notification('error', 'error', 'Insufficient wallet balance', 3000);
          document.getElementById("value").innerHTML = ''
          return;
      }
      document.getElementById("value").innerHTML = 
      `  
       <div class="alert alert-danger w-100" role="alert">
          <strong>The total value of this voucher will be : </strong> {{$general->cur_sym}} ${parseInt(total).toLocaleString()}
        </div>`
      }
  </script>
  @endpush

  <!-- add money modal start -->
  <form action="{{route('user.voucher.redeem')}}" method="post" class=""> 
    @csrf 
  <div class="modal add-money-modal fade" id="load-voucher" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Add Money</h2>
        </div>
        
        <div class="modal-body"> 
          <div class="form-group">
            <label for="inputamount" class="form-label mb-2">Code</label>
            <div class="form-input">
                <input class="form-control reason" type="password" required="" name="code" id="code"
                placeholder="**********" />
            </div>
          </div>
          <button type="submit" class="btn theme-btn successfully w-100">Load</button>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
</form>
  <!-- add money modal end -->
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('user.voucher.history') }}" class="back-btn">
    <i class="icon" data-feather="shopping-bag"></i>
  </a>
@endpush
