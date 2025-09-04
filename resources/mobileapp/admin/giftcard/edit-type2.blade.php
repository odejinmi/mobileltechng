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
                                        action="{{ route('admin.postcardtype') }}" name="editForm"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="col-12">
                                            <label class="form-label" for="modalEditUserFirstName">Giftcard Type:</label>
                                            <input type="text" class="form-control" placeholder="Card  Name"
                                                value="{{ $giftcardtype->name }}" name="name">
                                            <input hidden name="id" value="{{ $giftcardtype->id }}">

                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalEditUserLastName">Sell Card Rate</label>
                                            <input type="text" class="form-control"
                                                value="{{ $giftcardtype->sell_rate }}" name="sell_rate"
                                                placeholder="Card Sell Rate">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalEditUserName">Buy Card Rate</label>
                                            <input type="text" class="form-control" name="buy_rate"
                                                value="{{ $giftcardtype->buy_rate }}" placeholder="Card Buy Rate">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="modalEditUserEmail">Giftcard Currency</label>
                                            <input type="text"class="form-control" placeholder="Currency"
                                                value="{{ $giftcardtype->currency }}" name="currency">
                                        </div>

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
