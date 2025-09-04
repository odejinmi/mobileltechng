@extends('admin.layouts.app')

@section('panel')
    <div class="page-content">
        <div class="container">
            <div class="content-area card">
                <div class="card-innr">

                    <div class="rosw match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-12 col-12">

                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#creategiftcard"
                                                class="btn btn-sm btn-primary btn-outline"><em
                                                    class="ti ti-giftcard"></em>Create New Giftcard Type</a>

                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($giftcardtype as $data)
                                                    @php
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar rounded">
                                                                    <div class="avatar-content">
                                                                        <img width="40"
                                                                            src="{{ asset('assets/images/giftcards') }}/{{ @$giftcard->image }}"
                                                                            alt="Toolbar svg" />
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-bolder">{{ $data->name }}</div>
                                                                    <small> {{ $data->created_at }}</small>
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
                                        <a href="{{ route('admin.editcardtype2', $data->id) }}" class="btn btn-outline-primary"><i data-feather="eye"></i></a>
                                        @if ($data->status != 1)
                                        <a href="{{ route('admin.activatecardtype', $data->id) }}" class="btn btn-outline-success"><i data-feather="check"></i></a>
                                        @endif
                                        @if ($data->status == 1)
                                        <a href="{{ route('admin.deactivatecardtype', $data->id) }}" class="btn btn-outline-warning"><i data-feather="info"></i></a>
                                        @endif
                                        <a href="{{ route('admin.deletecardtype', $data->id) }}" class="btn btn-outline-danger"><i data-feather="trash"></i></a>
                                    </div>  

                                    </td>
                                    </tr>


                                    </td>
                                    </tr>
                                @empty
                                    Data not found
                                    @endforelse

                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Company Table Card -->



                </div>
            </div>
        </div>

        <!-- Card Modal -->
        <div class="modal fade" id="creategiftcard" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h4 class="popup-title">Create New {{ $giftcard->name }} Giftcard</h4>
                            <p>Fill the form below to create a new product type for the {{ $giftcard->name }}.</p>

                        </div>
                        <form role="form" method="POST" class="row gy-1 pt-75"
                            action="{{ route('admin.storecard2', $giftcard->id) }}" name="editForm"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-12">
                                <label class="form-label" for="modalEditUserFirstName">Giftcard Type:</label>
                                <input type="text" class="form-control" placeholder="Card  Name"
                                    value="{{ old('name') }}" name="name">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLastName">Sell Card Rate</label>
                                <input type="text" class="form-control" name="sell_rate" placeholder="Card Sell Rate">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserName">Buy Card Rate</label>
                                <input type="text" class="form-control" name="buy_rate" placeholder="Card Buy Rate">
                            </div>
                            <div class="col-12">
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
        <!--/ Card Modal -->
    @endsection
