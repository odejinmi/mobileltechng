@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- transfer-list starts -->
  <section>
    <ul class="transfer-list add-transfer-person">
      <li class="w-100">
        <div class="transfer-person transfer-box">
          <div class="transfer-img">
            <img class="img-fluid icon" src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}" alt="p1" />
          </div>
          <div class="transfer-details">
            <div>
              <h5 class="fw-semibold dark-text">{{Auth::user()->fullname}}</h5>
              <h6 class="fw-normal light-text mt-2">{{Auth::user()->email}}</h6>
            </div> 
          </div>
        </div>
      </li>
    </ul>
  </section>
  <!-- transfer-list end -->

  <!-- transfer details section start -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="title">
        <h2>Create Ticket</h2>
      </div>
        <form action="{{ route('ticket.store') }}" class="auth-form p-0" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
          <label for="inputbankname" class="form-label">Priority</label>
          <select name="priority" class="form-control form-select" required>
            <option value="3">@lang('High')</option>
            <option value="2">@lang('Medium')</option>
            <option value="1">@lang('Low')</option>
        </select>
        </div>

        <div class="form-group">
          <label for="inputcardnumber" class="form-label">Subject</label>
          <div class="form-input">
            <input type="text" required class="form-control" name="subject" id="inputcardnumber" placeholder="Enter Subject" />
          </div>
        </div>
        <input type="text" name="name" value="{{ @$user->firstname . ' ' . @$user->lastname }}" class="form-control form--control" required hidden>
        <input type="email" name="email" value="{{ @$user->email }}" class="form-control form--control" required hidden>

        <div class="form-group">
          <label for="inputamount" class="form-label">Message</label>
          <textarea name="message" id="inputMessage" rows="3" class="form-control" required>{{ old('message') }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputamount" class="form-label">Upload</label>
            <div class="upload-image rounded-image">
                <label for="formFileLg" class="form-label d-none">file </label>
                <input class="form-control upload-file" name="attachments[]" type="file" id="formFileLg">
                <i class="upload-icon dark-text" data-feather="upload"></i>
            </div>
        </div>
 
        <button type="submit" class="btn theme-btn w-100">Send</button>
      </form>
    </div>
  </section>
  <!-- transfer details section end -->
@endsection

@push('breadcrumb-plugins')
<a href="#"  onclick="history.back()" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush 
  
