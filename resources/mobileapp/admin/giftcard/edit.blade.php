@extends('admin.layouts.app')

@section('panel')
<div class="page-content">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">

              <div class="modasl fasde" id="creategiftcard" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                      <div class="modal-content"> 
                          <div class="modal-body pb-5 px-sm-5 pt-50">
                              <div class="text-center mb-2">
                                  <h4 class="popup-title">Update {{ $giftcard->name }} Giftcard</h4>
                                  <p>Fill the form below to update {{ $giftcard->name }}.</p>

                              </div>
                              <form role="form" method="POST" class="row gy-1 pt-75"
                                  action="{{ route('admin.postcard') }}" name="editForm"
                                  enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="col-12 mb-4">
                                      <label class="form-label" for="modalEditUserFirstName">Giftcard Name:</label>
                                      <input type="text" class="form-control" placeholder="Card  Name"
                                          value="{{ $giftcard->name }}" name="name">
                                      <input hidden name="id" value="{{ $giftcard->id }}">

                                  </div>
                                   
                                  <div class="col-12 mb-4">
                                      <label class="form-label" for="modalEditUserEmail">Giftcard Currency</label>
                                      <input type="file"class="form-control" placeholder="Currency" value="{{$giftcard->image}}"
                                      name="photo">
                                  </div>
                                  <span class="topbar-logo">
                                    <img src="{{asset('assets/images/giftcards')}}/{{$giftcard->image}}"  width="100" alt="{{$giftcard->image}}">
                                  </span>

                                  <div class="col-12 text-center mt-2 pt-50">
                                      <button type="submit" class="btn btn-primary me-1">Submit</button>
                                     
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div><!-- .card-innr -->
  </div><!-- .card -->
</div>  
@stop

@push('breadcrumb-plugins')
<a class="btn btn-sm btn-primary" href="{{ route('admin.giftcardindex') }}">@lang('Back')</a>
@endpush