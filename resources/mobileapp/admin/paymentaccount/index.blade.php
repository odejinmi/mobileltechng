@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Currency')</th>
                                    <th>@lang('Rate')</th>
                                    <th>@lang('Fee')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($accounts as $data)
                                    <tr>
                                        <td>{{ $accounts->firstItem() + $loop->index }}</td>
                                        <td>{{ __($data->name) }}</td>
                                        <td>{{ __($data->currency) }}</td>
                                        <td>1 {{ __($data->currency) }} = {{number_format($data->rate,2)}} {{$general->cur_text}}</td>
                                        <td>{{ __($data->fee) }}%</td>
                                        <td>
                                            @php
                                                echo $data->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary cuModalBtn" data-resource="{{ $data }}" data-modal_title="@lang('Update Category')">
                                                <i class="la la-pencil"></i>@lang('Edit')
                                            </button>
                                            
                                            @if ($data->status == Status::DISABLE)
                                                <button type="button" class="btn btn-sm btn-success confirmationBtn" data-action="{{ route('admin.paymentaccount.status', $data->id) }}" data-question="@lang('Are you sure to enable this account?')">
                                                    <i class="la la-eye"></i>@lang('Enable')
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-danger confirmationBtn" data-action="{{ route('admin.paymentaccount.delete', $data->id) }}" data-question="@lang('Are you sure to delete this account?')">
                                                    <i class="la la-eye-slash"></i>@lang('Delete')
                                                </button>
                                             
                                                <button type="button" class="btn btn-sm btn-warning confirmationBtn" data-action="{{ route('admin.paymentaccount.status', $data->id) }}" data-question="@lang('Are you sure to disable this account?')">
                                                    <i class="la la-eye-slash"></i>@lang('Disable')
                                                </button>
                                            @endif 
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($accounts->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($accounts) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

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
                <form action="{{ route('admin.paymentaccount.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label>@lang('Name')</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mb-4">
                            <label>@lang('Currency')</label>
                            <input type="text" class="form-control" name="currency">
                        </div>

                        <div class="form-group mb-4">
                            <label>@lang('Account Details')</label>
                            <input type="text" class="form-control" name="details">
                        </div>
                        <div class="form-group mb-4">
                            <label>@lang('Exchange Rate')</label>
                            <input type="text" class="form-control" name="rate">
                        </div>
                        <div class="form-group">
                            <label>@lang('Fee')</label>
                            <input type="text" class="form-control" name="fee">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <button type="button" class="btn btn-sm btn-primary me-2 h-45 cuModalBtn" data-modal_title="@lang('Add New')">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush
