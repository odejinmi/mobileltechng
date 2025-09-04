@extends($activeTemplate . 'layouts.dashboard')
@section('panel') 

  <!-- my account section start -->
  <section class="section-b-space">
    <div class="custom-container">
       <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="p3" />
          </div>
        </div>
         
          <form action="{{ route('user.post_withdraw.card', $vcards->card_id) }}" class="auth-form pt-0 mt-3" method="post" enctype="multipart/form-data">
               @csrf 
              @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
              @endif 
        
        <div class="form-group">
          <label for="inputusername" class="form-label">Amount <b>(USD)</b></label>
          <div class="form-input">
                    <input type="text" class="form-control" name="amount" required="">

          </div>
        </div>
         

        <button type="submit" class="btn theme-btn w-100">Withdraw</button>
      </form>
    </div>
  </section>
  <!-- my account section end -->

  
@endsection
@push('breadcrumb-plugins') 
@endpush