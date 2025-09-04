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
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Types</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($currency as $k => $data)
                                    @php
                                        $type = App\Models\Giftcardtype::whereCardId($data->id)->count();
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/giftcards') }}/{{ $data->image }}"
                                                    class="rounded-circle" alt="..." width="56" height="56">
                                                <div class="ms-3">
                                                    <h6 class="fw-semibold mb-0 fs-4">{{ $data->name }}</h6>
                                                    <p class="mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($data->status == 1)
                                                    <span class="text-bg-success p-1 rounded-circle"></span>
                                                    <p class="mb-0 ms-2">Active</p>
                                                @else
                                                    <span class="text-bg-danger p-1 rounded-circle"></span>
                                                    <p class="mb-0 ms-2">Inactive</p>
                                                @endif

                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 fs-4">{{ $type }}</h6>
                                        </td>
                                        <td>
                                             <div class="btn-group mb-2">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @can('admin.editcardType')
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.editcardType', $data->id) }}">@lang('Manage')</a>
                                                    </li>
                                                    <hr>
                                                    @endcan

                                                    @can('admin.editcard')
                                                    <li><a class="dropdown-item"
                                                        href="{{ route('admin.editcard', $data->id) }}">@lang('Edit')</a>
                                                    </li>
                                                    @endcan
                                                    @if ($data->status != 1)
                                                    @can('admin.activatecard')
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.activatecard', $data->id) }}">@lang('Activate')</a>
                                                        </li>
                                                    @endcan
                                                    @else
                                                    @can('admin.deactivatecard')
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.deactivatecard', $data->id) }}">@lang('Deactivate')</a>
                                                        </li>
                                                    @endcan
                                                    @endif
                                                    @can('admin.deletecard')
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.deletecard', $data->id) }}">@lang('Delete')</a>
                                                    </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    <div class="modal fade" id="createcard" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Extra Large modal
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" method="POST" action="{{ route('admin.storecard') }}" name="editForm"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group col-md-12 mb-4">
                            <label class="input-item-label text-exlight">Giftcard Name:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Currency  Name"
                                    value="{{ old('name') }}" name="name">

                            </div>

                        </div>
                        <div class="form-group col-md-12 mb-4">
                            <label class="input-item-label text-exlight"> Giftcard Image:</label>
                            <input type="file" class="form-control" name="photo">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn bg-danger-subtle text-danger font-medium waves-effect text-start"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Create Giftcard</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection


    @push('breadcrumb-plugins')
    @can('admin.storecard')
        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal"
            data-bs-target="#createcard">@lang('Add New Giftcard')</a>
    @endcan
    @endpush
