@extends('admin.layouts.app')

@section('panel')

<div class="body-wrappser">

  <div class="product-list">
      <div class="card">
          <div class="card-body p-3">
              <div class="table-responsive border rounded">
                  <table class="table align-middle text-nowrap mb-0">
                      <thead>
                        <tr>
                          <th>Type</th>
                          <th>Status</th> 
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($currency as $k=>$data)

                        @php  
                        @endphp
                        <tr>
                          <td>
                            <div class="d-flex align-items-center"> 
                              <div>
                                <div class="avatar-content">
                                  <img width="40" src="{{ asset('assets/images/giftcards') }}/{{ $giftcard->image }}" alt="Toolbar svg" />
                                </div>
                                <div class="fw-bolder">{{$data->name }}</div>
                                <small>  {{ $data->created_at }}</small>
                              </div>
                            </div>
                          </td>  
                          <td class="text-nowrap">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder me-1">
                                    @if ($data->status == 1)
                                    <span
                                        class="dt-type-md badge badge-outline bg-success badge-md">Active</span>
                                   @else
                                    <span
                                        class="dt-type-md badge badge-outline bg-warning badge-md">Inactive</span>                                         
                                    </span>
                                    @endif
                                  </span>
                            </div>
                          </td> 
                          <td>  
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @can('admin.updatecardType')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editgiftcard{{$data->id}}"  class="btn bg-light-primary  btn-xs btn-icon  btn-outline-primary">Edit</a>
                                @endcan
                                @if ($data->status != 1)
                                @can('admin.activatecardtype')
                                <a href="{{ route('admin.activatecardtype', $data->id) }}" class="btn bg-light-success  btn-xs btn-icon btn-outline-success">Activate</a>
                                @endcan
                                @endif
                                @if ($data->status == 1)
                                @can('admin.deactivatecardtype')
                                <a href="{{ route('admin.deactivatecardtype', $data->id) }}" class="btn btn-xs btn-icon  bg-light-warning btn-outline-warning">Deactivate</a>
                                @endcan
                                @endif
                                @can('admin.deletecardtype')
                                <a href="{{ route('admin.deletecardtype', $data->id) }}" class="btn  btn-xs btn-icon  bg-light-danger btn-outline-danger">Delete</a>
                                @endcan
                            </div> 
                          </td>
                        </tr>


 
 <!-- Edit Modal -->
 <div class="modal fade" id="editgiftcard{{$data->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
      <div class="modal-content">
          <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                  <h4 class="popup-title">Update {{$data->name}}</h4>
                  <p>Fill the form below to update giftcard type.</p>

              </div>
              <form role="form" method="POST" class="row gy-1 pt-75"
                  action="{{ route('admin.updatecardType', $data->id) }}" name="editForm"
                  enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserFirstName">Giftcard Type:</label>
                      <input type="text" class="form-control" placeholder="Card  Name"
                          value="{{ $data->name }}" name="name">
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserLastName">Sell Card Rate</label>
                      <input type="text" class="form-control"  value="{{ $data->sell_rate }}" name="sell_rate" placeholder="Card Sell Rate">
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserName">Buy Card Rate</label>
                      <input type="text" class="form-control"  value="{{ $data->buy_rate }}" name="buy_rate" placeholder="Card Buy Rate">
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserEmail">Giftcard Currency</label>
                      <input type="text" class="form-control" placeholder="Currency"
                         value="{{ $data->currency }}" name="currency">
                  </div>

                  <div class="col-12 text-center mt-2 pt-50">
                      <button type="submit" class="btn btn-primary me-1">Submit</button>
                      <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                          aria-label="Close">
                          Discard
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<!--/ Edit Modal -->

                        @empty
                        Data not found
                        @endforelse
                      </tbody>
                  </table>

              </div>

          </div>
      </div>
  </div>


        <!-- Create Modal -->
        <div class="modal fade" id="creategiftcard" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h4 class="popup-title">Create New Giftcard</h4>
                            <p>Fill the form below to create a new giftcard.</p>

                        </div>
                        <form role="form" method="POST" class="row gy-1 pt-75"
                            action="{{ route('admin.storecardType', $giftcard->id) }}" name="editForm"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-12 mb-3">
                                <label class="form-label" for="modalEditUserFirstName">Giftcard Type:</label>
                                <input type="text" class="form-control" placeholder="Card  Name"
                                    value="{{ old('name') }}" name="name">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="modalEditUserLastName">Sell Card Rate</label>
                                <input type="text" class="form-control" name="sell_rate" placeholder="Card Sell Rate">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="modalEditUserName">Buy Card Rate</label>
                                <input type="text" class="form-control" name="buy_rate" placeholder="Card Buy Rate">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="modalEditUserEmail">Giftcard Currency</label>
                                <input type="text"class="form-control" placeholder="Currency"
                                    value="{{ old('currency') }}" name="currency">
                            </div>

                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    Discard
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Create Modal -->
@endsection

@push('breadcrumb-plugins')
@can('admin.storecardType')
<a href="#" data-bs-toggle="modal" data-bs-target="#creategiftcard" class="btn btn-sm btn-primary btn-outline"><em class="ti ti-giftcard"></em>New Giftcard Type</a>
@endcan
@endpush