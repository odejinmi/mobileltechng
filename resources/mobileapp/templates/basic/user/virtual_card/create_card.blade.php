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
         
          <form action="{{route('user.create.card.add')}}" class="auth-form pt-0 mt-3" method="post" enctype="multipart/form-data">
               @csrf 
              @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
              @endif 
        <div class="form-group">
          <label for="inputpin" class="form-label">Card Holder's Name</label>
                    <input type="text" class="form-control" name="card_holder_name" required="">

        </div>

        <div class="form-group">
          <label for="inputusername" class="form-label">Amount <b>(USD)</b></label>
          <div class="form-input">
                    <input type="text" class="form-control" name="amount" required="">

          </div>
        </div>
         <strong style="color: orange;">Rate: &#8358;{{ $general->virtualcard_usd_rate }} = $1</strong>
<br>
<strong style="color: orange;">Card Creation Fee - 1.99% + $1.99</strong>


        <button type="submit" class="btn theme-btn w-100">Create Card</button>
      </form>
    </div>
  </section>
  <!-- my account section end -->

 
@endsection
@push('breadcrumb-plugins') 
@endpush