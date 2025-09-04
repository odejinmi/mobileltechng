@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

   
   <!-- change password section start -->
   <section>
    <div class="custom-container">
      <h4 class="fw-normal light-text lh-base">Enter your current password and enter a new password to change your account passwords.
      </h4>
        <form class="auth-form pt-0 mt-3" class="form" novalidate="novalidate" action="{{ route('user.change.password') }}" method="POST"  enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="inputpin" class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password" id="current_password" />        
          </div>
          
          <div class="form-group">
            <label for="inputpin" class="form-label">New Password</label>
            <input type="password" class="form-control" name="password" id="password" />        
          </div>
          <div class="form-group">
            <label for="inputpin" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />        
          </div>
  
            
        <button type="submit" class="btn theme-btn w-100">Change password</button>
      </form>
    </div>
  </section>
  <!-- change password section start -->
@endsection

@push('breadcrumb-plugins')
<a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush
 
