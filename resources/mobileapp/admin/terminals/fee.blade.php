@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('From')</th>
                                    <th>@lang('To')</th>
                                    <th>@lang('Fee')</th>  
                                    <th>@lang('Cap')</th>  
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allfees as $data)
                                    <tr>
                                        <td>{{ $loop->index + $allfees->firstItem() }}</td>
                                        <td>{{ number_format($data->from,2)}}</td>
                                        <td>{{ number_format($data->to,2)}}</td>
                                        <td>{{ @$data->fee}}</td>
                                         <td>{{$general->cur_sym}}{{ number_format($data->cap,2)}}</td>
                                         

                                        <td>
                                            <div class="button--group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                                                        <i class="la la-pencil"></i>@lang('Manage')
                                                    </button> 
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Create Update Modal -->
                                    <div class="modal fade" id="exampleModal{{$data->id}}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>

                                                <form action="{{route('admin.terminal.feeUpdate',$data->id)}}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">


                                                        <div class="form-group mb-3">
                                                            <label>@lang('From')</label>
                                                            <input type="number" value="{{$data->from}}" class="form-control" name="from" required>
                                                        </div> 

                                                        <div class="form-group mb-3">
                                                            <label>@lang('To')</label>
                                                            <input type="number" value="{{$data->to}}"  class="form-control" name="to" required>
                                                        </div> 

                                                        <div class="form-group mb-3">
                                                            <label>@lang('Fee') <b>(%)</b></label>
                                                            <input type="number" value="{{$data->fee}}"  class="form-control" name="fee" required>
                                                        </div> 

                                                        <div class="form-group mb-3">
                                                            <label>@lang('Cap') <b>({{$general->cur_sym}})</b></label>
                                                            <input type="number"  value="{{$data->cap}}" class="form-control" name="cap" required>
                                                        </div> 


                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary w-100 h-45">@lang('Create')</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($allfees->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($allfees) }}

                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    <!-- Create Update Modal -->
    <div class="modal fade" id="cuModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
 

                        <div class="form-group mb-3">
                            <label>@lang('From')</label>
                            <input type="number" class="form-control" name="from" required>
                        </div> 
 
                        <div class="form-group mb-3">
                            <label>@lang('To')</label>
                            <input type="number" class="form-control" name="to" required>
                        </div> 
 
                        <div class="form-group mb-3">
                            <label>@lang('Fee') <b>(%)</b></label>
                            <input type="number" class="form-control" name="fee" required>
                        </div> 
 
                        <div class="form-group mb-3">
                            <label>@lang('Cap') <b>({{$general->cur_sym}})</b></label>
                            <input type="number" class="form-control" name="cap" required>
                        </div> 
 

                    </div>
                         <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 h-45">@lang('Create')</button>
                        </div>
                 </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Serial Number" />
    <button type="button" class="btn btn-sm btn-outline-primary cuModalBtn" data-modal_title="@lang('Add New Fee')">
        <i class="las la-plus"></i>@lang('Add New Fee')
    </button>
@endpush

@push('script')
     
@endpush
