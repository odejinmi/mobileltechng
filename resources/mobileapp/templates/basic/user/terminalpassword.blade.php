@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

   
   <!-- change password section start -->
   <section>
    <div class="custom-container">
      <h4 class="fw-normal light-text lh-base">Enter your current password and enter a new terminal PIN to change your terminal PIN.
      </h4>
        <form class="auth-form pt-0 mt-3" class="form" novalidate="novalidate" action="{{ route('user.change.terminalpassword') }}" method="POST"  enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="inputpin" class="form-label">Current Password</label>
            <input type="password" class="form-control" name="password" id="password" />        
          </div>
          
          <div class="form-group">
            <label for="inputpin" class="form-label">New PIN</label>
            <input type="number" maxlengh="6" class="form-control" name="pin" id="pin" />        
          </div> 
  
            
        <button type="submit" class="btn theme-btn w-100">Update PIN</button>
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
 
