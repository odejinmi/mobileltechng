@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

<!-- profile section start -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="p3" />
          </div>
        </div>
        <h2>Visa Card</h2>
        <h5></h5>
      </div>

      <ul class="profile-list">
        <li>
          <a href="{{url('/user/create/customer')}}" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="user"></i>
            </div>
            <div class="profile-details">
              <h4>Card Holder</h4>
              <img class="img-fluid arrow" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')}}" alt="arrow" />
            </div>
          </a>
        </li>
        <li>
          <a href="{{url('/user/create/card')}}" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="credit-card"></i>
            </div>
            <div class="profile-details">
              <h4>Create Card</h4>
              <img class="img-fluid arrow" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')}}" alt="arrow" />
            </div>
          </a>
        </li>
    </div>
</section>
  
  <!-- cards section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <ul class="card-list">
        @forelse($vcards as $key=>$row)
        <li class="credit-card-box color1">
          <div class="card-logo">
            <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="logo1" />
             
             <div class="dropdown">
              <a href="#" class="back-btn" role="button" data-bs-toggle="dropdown">
                <i class="icon" data-feather="more-horizontal"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{url('/user/view/card/'.$row->id)}}">View</a></li>
                <li><a class="dropdown-item" href="{{url('/user/withdraw/card/'.$row->id)}}">Withdraw</a></li>
                <li><a class="dropdown-item" href="{{url('/user/freeze/card/'.$row->id)}}">Freeze</a></li>
                <li><a class="dropdown-item" href="{{url('/user/unfreeze/card/'.$row->id)}}">Unfreeze</a></li>
              </ul>
            </div>
            
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-number"> @isset($row->card_id){{$row->card_id}}@endisset </h6>
              <h5 class="card-name">Ref: @isset($row->reference){{$row->reference}}@endisset</h5>
            </div>
            <img class="img-fluid chip" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/card-chip.svg')}}" alt="card-chip" />
          </div>
          <div class="d-flex justify-content-between">
            <h2 class="card-amount">
                
            </h2>
            <div class="card-date w-100">
              <h6></h6>
              <h6 class="text-white fw-semibold mt-1"></h6>
            </div>
            <div class="card-numbers w-100">
              <h6 class="cvv-code">Type</h6>
              <h6 class="text-white fw-semibold mt-1">@isset($row->card_type){{$row->card_type}}@endisset</h6>
            </div>
          </div>
        </li>

        @empty
                                    {!! emptyData2() !!}
                                @endforelse
      </ul>
    </div>
    @if ($vcards->hasPages())
                        <div class="card-footer">
                            {{ $transactions->links() }}
                        </div>
                    @endif
  </section>
  <!-- cards section end -->
  
  
@endsection
