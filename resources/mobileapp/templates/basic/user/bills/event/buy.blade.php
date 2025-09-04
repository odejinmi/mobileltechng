@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row">
        <div class="col-12">
          
          <div class="checkout">
            <div class="card shadow-none border">
              <div class="card-body p-4">
                <div class="wizard-content">
                  <form action="#" class="tab-wizard wizard-circle">
                    <!-- Step 1 -->
                    <p>{{$event->title}}. {{showDate($event->start_date)}} </p>
                    <small>{{$event->location->name}} {{$event->city->name}}</small>
                    <section>
                      <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                          <thead class="fs-2">
                            <tr>
                              <th>Ticket</th>
                              <th>Quantity</th>
                              <th class="text-end">Price</th>
                            </tr>
                          </thead>
                          
                          <tbody>
                            @if($event->tickets != null)
                            @php
                            $tickets = json_encode($event->tickets, true);
                            $tickets = json_decode($tickets, true);
                            @endphp
                            <input hidden name="event_id" value="{{$event->id}}">
                            @foreach($tickets as $k => $v)
                            <tr>
                              <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-3 overflow-hidden">
                                  <img src="{{getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])}}" alt="" class="img-fluid rounded"
                                    width="80">
                                  <div>
                                    <h6 class="fw-semibold fs-4 mb-0">{{$v['name']}}</h6> 
                                  </div>
                                </div>
                              </td>
                              <td class="border-bottom-0">
                                <div class="input-group input-group-sm flex-nowrap rounded">
                                  <button
                                    class="btn minus min-width-40 py-0 border-end border-success border-end-0 text-success"
                                    type="button" id="add1" cart-add-btn" data-id="{{$v['name']}}"><i class="ti ti-minus"></i></button>
                                  <input type="text" name="quantity" id="{{$v['trx']}}" class="quantity__value min-width-40 flex-grow-0 border border-success text-success fs-3 fw-semibold form-control text-center qty"
                                    placeholder="" aria-label="Example text with button addon" aria-describedby="add1"
                                    value="0">
                                  <input id="{{$v['trx']}}name" hidden value="{{$v['name']}}">
                                  <button
                                    class="btn min-width-40 py-0 border border-success border-start-0 text-success add  cart-add-btn" data-id="{{$v['trx']}}"
                                    type="button" id="addo2" ><i class="ti ti-plus"></i></button>
                                </div>
                              </td>
                              <td class="text-end border-bottom-0">
                                <h6 class="fs-4 fw-semibold mb-0"> {{$general->cur_sym}} {{@number_format($v['price'],2)}} </h6>
                              </td>
                            </tr>
                            @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                      <div class="order-summary border rounded p-4 my-4">
                        <div class="p-3">
                          <h5 class="fs-5 fw-semibold mb-4">Order Summary</h5>
                         
                          <div class="cart-products cart--products"> </div>
                          <a href="{{route('user.event.ticket.buy.proceed',encrypt($event->id))}}" class="btn btn-sm btn-primary">
                            <span class="d-inline-block"> @lang('Continue')</span>
                          </a> 
                        </div>
                      </div>
                    </section>  
                  </form>
                </div>
              </div>
            </div>
          </div>



@endsection

@push('breadcrumb-plugins')
@endpush
@push('script')


  <script src="{{ asset('assets/assets/dist/libs/owl.carousel/dist/assets/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('assets/assets/dist/js/productDetail.js')}}"></script>
  @endpush

@push('script')
<script>
           
            $.ajax({
                url: "{{ route('user.event.get-cart-total') }}",
                method: "get",
                success: function (response) {
                    $('.cart-count').text(response);
                }
            });
 
         $(document).on('click', '.cart-add-btn', function (e) {
            console.info('E dey work');
            var ticket_id = $(this).data('id');
            var attributes = $('.attribute-btn.active');
            var output = '';
             
            $('.attr-data').html(output);
            var qtyvalue = document.getElementById(ticket_id).value;
            var name = document.getElementById(ticket_id+'name').value;
            var quantity = $('input[name="quantity"]').val();
            var quantity = $('input[name="quantity"]').val();
            var event = $('input[name="event_id"]').val();
            var qty = qtyvalue;
            $.ajax({
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", },
                url: "{{route('user.event.add-to-cart')}}",
                method: "POST",
                data: { name: name, event: event, ticket_id: ticket_id, quantity: qty },
                success: function (response) {
                    if (response.success) {
                        getCartData();
                        getCartTotal();
                        notify('success', response.success);
                    } else {
                        notify('error', response.error);
                    }
                }
            });

        });

          
        function getCartData() {
            $.ajax({
                url: "{{ route('user.event.get-cart-data') }}",
                method: "get",
                success: function (response) {
                    $('.cart--products').html(response);
                }
            });
        }
        function getCartTotal() {
            $.ajax({
                url: "{{ route('user.event.get-cart-total') }}",
                method: "get",
                success: function (response) {
                    $('.cart-count').text(response);
                }
            });
        }

        $(document).on('click', '.remove-cartitem', function (e) {
            var btn         = $(this);
            var id          = btn.data('id'); 

            var url = `{{route('user.event.remove-cart-item', '')}}/${id}`;
            $.ajax({
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                url: url,
                method: "POST",
                success: function (response) {
                    if (response.success) {
                        notify('success', response.success); 
                        getCartData();
                        getCartTotal();
                    } else {
                        notify('error', response.error);
                    }
                }
            });
        });

</script>
    <script>
        (function ($) {

            $.ajax({
                url: "{{ route('user.event.get-cart-data') }}",
                method: "get",
                success: function (response) {
                    $('.cart--products').html(response);
                }
            });
            "use strict";
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(
                    `<div class="input-group mt-2">
                        <input type="file" name="attachments[]" class="form-control" required />
                        <span class="input-group-text btn btn-sm btn--danger support-btn remove-btn"><i class="las la-times"></i></span>
                    </div>`
                )
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);

    </script>
@endpush

