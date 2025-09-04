
<ul class="list gap-4">
    @forelse ($data as $item)
    @php
    $event = App\Models\Event::whereId($item->event_id)->first();
    $ticket = [];
    foreach($item->event->tickets as $data)
    {
       if($data->trx == $item->ticket_id)
       {
        $ticket = $data;
       }
    }
    @endphp

    <div class="d-flex justify-content-between mb-4">
      <p class="mb-0 fs-4">{{@$ticket->name}} <b class="text-primary">(<small>{{$item->quantity}} Slots</small>)</b></p>
      <h6 class="mb-0 fs-4 fw-semibold">{{$general->cur_sym}}{{getAmount($item->price*$item->quantity, 2)}}</h6>
      <p class="mb-0 fw-medium"><a href="javascript:void(0)" class="remove-cartitem" data-id="{{$item->id}}""><i class="text-danger fa fa-trash"></i></a></p>
    </div> 

    @empty
    {!!emptyData2()!!}
    @endforelse

    <div class="hr-dashed my-4"><hr></ht></div>

    <div class="d-flex justify-content-between">
      <h6 class="mb-0 fs-4 fw-semibold">Total</h6>
      <h6 class="mb-0 fs-5 fw-semibold">{{$general->cur_sym}} {{getAmount($subtotal,2)}}</h6>
    </div> 
</ul>
 @push('script')
 <script>

 </script>
@endpush

