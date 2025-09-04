@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- my account section start -->
  <section class="section-b-space">
    <div class="custom-container">
        @if(!empty($customer))
      <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="p3" />
          </div>
        </div>
        <h2>First Name:  @isset($customer->first_name){{$customer->first_name}}@endisset</h2>
        <h2>Last Name:  @isset($customer->last_name){{$customer->last_name}}@endisset</h2>
        <h2>Email:  @isset($customer->customer_email){{$customer->customer_email}}@endisset</h2>
        <h2>Phone: @isset($customer->phone_number){{$customer->phone_number}}@endisset</h2>
        <h2>DOB: @isset($customer->date_of_birth){{$customer->date_of_birth}}@endisset</h2>
        <h2>House Number: @isset($customer->house_number){{$customer->house_number}}@endisset</h2>
        <h5>Customer ID: @isset($customer->bitvcard_customer_id){{$customer->bitvcard_customer_id}}@endisset</h5>
      </div>
      @else

          <form action="{{route('user.create.customer.add')}}" class="auth-form pt-0 mt-3" method="post" enctype="multipart/form-data">
                @csrf
        <div class="form-group">
          <label for="inputpin" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" name="phone_number">

        </div>

        <div class="form-group">
          <label for="inputusername" class="form-label">Date Of Birth</label>
          <div class="form-input">
                                  <input type="text" class="form-control" name="date_of_birth">

          </div>
        </div>
        <div class="form-group">
          <label for="inputusername" class="form-label">Address</label>
          <div class="form-input">
                        <input type="text" class="form-control" name="line">

          </div>
        </div>
        <div class="form-group">
          <label for="inputusername" class="form-label">Zip Code</label>
          <div class="form-input">
                        <input type="text" class="form-control" name="zip_code">

          </div>
        </div> 

        <button type="submit" class="btn theme-btn w-100">Create CardHolder</button>
      </form>
      @endif
    </div>
  </section>
  <!-- my account section end -->



@endsection
@push('breadcrumb-plugins') 
@endpush