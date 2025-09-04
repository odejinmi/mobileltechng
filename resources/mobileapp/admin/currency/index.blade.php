@extends('admin.layouts.app')
@section('panel')
     <!-- drives area starts-->
    <div class="drives">
      <div class="row">
        <div class="col-12">
          <h6 class="files-section-title mb-75">Available  Currencies</h6>
        </div>
        @foreach($currency as $data)
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card shadow-none border cursor-pointer">
            <div class="card-body">
               
              <div class="my-1">
                <h5>{{$data->name}} <small>{{$data->symbol}}</small></h5>
              </div>
               <p class="text-muted text-center mt-1 col-6">
										@if($data->status == 1)
										<a class="badge bg-success text-white">Status :Active</a>
										@else
										<a class="badge bg-danger text-white">Status: Inactive</a>
										@endif
										</p>
                    @can(['admin.crypto.deactivatecoin*','admin.crypto.activatecoin*','admin.crypto.edit*'])
                    <div class="btn-group mb-2">
                      <button
                        class="btn btn-light-primary btn-sm text-primary dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        @lang('Manage')
                      </button>
                      <ul
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                       @if($data->status == 1)
                       @can(['admin.crypto.deactivatecoin*'])
                        <li><a class="dropdown-item" href="{{ route('admin.crypto.deactivatecoin',$data->id) }}">@lang('Deactivate')</a></li>
                      @endcan
                        @else
                        @can(['admin.crypto.activatecoin*'])
                        <li>
                          <a class="dropdown-item" href="{{ route('admin.crypto.activatecoin',$data->id) }}">@lang('Activate')</a>
                        </li>
                        @endcan
                        @endif
                        @can(['admin.crypto.edit*'])
                        <li>
                          <a class="dropdown-item" href="{{ route('admin.crypto.edit',$data->id)}}">@lang('Settings')</a>
                        </li>
                        @endcan
                      </ul>
                    </div>
              @endcan
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <!-- drives area ends-->

    <div id="CurrencyModel" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">@lang('Add New Asset')</h5> 
              </div>
              <form action="{{route('admin.crypto.addcoin')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group mb-3">
                          <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                          <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="@lang("Enter Name")"  maxlength="80" required="">
                      </div>
                      <div class="form-group mb-3">
                        <label for="symbol" class="form-control-label font-weight-bold">@lang('Symbol')</label>
                        <input type="text" class="form-control form-control-lg" name="symbol" id="symbol" placeholder="@lang("Enter Symbol")"  maxlength="80" required="">
                    </div>

                      <div class="form-group mb-3">
                          <label for="symbol" class="form-control-label font-weight-bold">@lang('Logo Image')</label>
                          <div class="custom-file">
                            <input type="file" name="logo" class="form-control" id="customFileLangHTML">
                           </div>
                      </div> 
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>@lang('Create')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

    @push('breadcrumb-plugins')
        <a href="javascript:void(0)" class="btn btn-sm btn-primary box--shadow1 text--small addCurrency" ><i class="fa fa-fw fa-plus"></i>@lang('Add Asset')</a>
    @endpush 
@endsection

@push('script')
<script>
    "use strict";
    $('.addCurrency').on('click', function() {
        $('#CurrencyModel').modal('show');
    });
</script>
@endpush
