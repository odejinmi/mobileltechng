@extends($activeTemplate . 'layouts.dashboard')
@section('panel') 


  <!-- monthly statistics section starts -->
  <section>
    <div class="custom-container">
      <div class="statistics-banner">
        <div class="d-flex justify-content-center gap-3">
          <div class="statistics-image">
            <i class="icon" data-feather="plus"></i>
          </div>
          <div class="statistics-content d-block">
            <h5>Add Invoice</h5>
            <h6>Fill the form below to create invoice</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- monthly statistics section end -->

<section class="section-b-space">
    <div class="custom-container">
        <form  class="auth-form p-0" action="" method="post">
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
      </section>
      <div class="form-group">
        <label for="inputmessage" class="form-label">Narration</label>
        <div class="form-input">
          <textarea class="form-control" id="inputmessage" name="purpose" value="{{ old('purpose') }}" rows="3" placeholder="Write here"></textarea>
        </div>
      </div>

        <button type="submit" class="btn theme-btn w-100" >Create</button>
      </form>
    </div>
  </section>
  <!-- request section end -->
 
  
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('user.invoice.history') }}" class="back-btn">
  <i class="icon" data-feather="printer"></i>
</a>
@endpush