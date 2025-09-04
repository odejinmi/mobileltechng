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
                                    <th>@lang('Terminal ID')</th>
                                    <th>@lang('Serial Number')</th>
                                    <th>@lang('Customer')</th>  
                                    <th>@lang('Status')</th>  
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allTerminals as $data)
                                    <tr>
                                        <td>{{ $loop->index + $allTerminals->firstItem() }}</td>
                                        <td>{{ $data->terminal_id }}</td>
                                        <td>{{ __($data->terminal_sn) }}</td>
                                        <td>{{ @$data->user->username ?? 'N/A'}}<br>
                                        <small>{{ @$data->user->email }}</small>
                                        </td> 

                                        <td>
                                            @php
                                                echo $data->statusBadge;
                                            @endphp
                                        </td>

                                        <td>
                                            <div class="button--group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                                                        <i class="la la-pencil"></i>@lang('Manage')
                                                    </button> 
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Create Update Modal -->
                                    <div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>

                                                <form action="{{route('admin.terminal.unmap', $data->terminal_id)}}" method="POST">
                                                    @csrf
                                                    <div class="modal-body"> 

                                                        <div class="form-group mb-3">
                                                            <label>@lang('Customer')</label>
                                                            <select name="user" class="form-control" required>
                                                                <option value="" disabled selected>@lang('Select One')</option>
                                                                <option value="0">UNMAP TERMINAL</option>
                                                                @foreach ($users as $user)
                                                                    <option @if($user->id == $data->user_id) selected @endif value="{{ $user->id }}">{{ $user->username }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> 

                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary w-100 h-45">@lang('Submit')</button>
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
                @if ($allTerminals->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($allTerminals) }}

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
                            <label>@lang('Serial Number')</label>
                            <input type="text" class="form-control" name="serialnumber" required>
                        </div> 

                        <div class="form-group mb-3">
                            <label>@lang('Customer')</label>
                            <select name="user" class="form-control" required>
                                <option value="" disabled selected>@lang('Select One')</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div> 

                    </div>
                         <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 h-45">@lang('Submit')</button>
                        </div>
                 </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Serial Number" />
    <button type="button" class="btn btn-sm btn-outline-primary cuModalBtn" data-modal_title="@lang('Add New Terminal')">
        <i class="las la-plus"></i>@lang('Add New TYerminal')
    </button>
@endpush

@push('script')
     
@endpush
