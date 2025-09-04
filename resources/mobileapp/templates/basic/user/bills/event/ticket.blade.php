@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                  <h2 class="fw-bolder mb-0 fs-8 lh-base">{{$event->title}}</h2>
                </div>
              </div> 

              <div class="row">
                @foreach($tickets as $data)

                @php

                $tickets = json_encode($data->event->tickets, true);
                $tickets = json_decode($tickets, true);
                $name = null;
                foreach($tickets as $k => $v)
                {
                    if($v['trx'] == $data->ticket_id)
                    $name = $v['name'];
                }
                @endphp
                <div class="col-sm-6 col-lg-4" id="{{$data->code}}">
                    <div class="card">
                      <div class="card-body pt-6">
                        <div class="text-end">
                          <span
                            class="badge fw-bolder py-1 @if($data->status != 1) bg-danger-subtle text-danger @else bg-success-subtle text-success @endif text-uppercase fs-2 rounded-3">{{$data->code}}</span>
                        </div>
                        <span class="fw-bolder text-uppercase fs-2 d-block mb-7">{{$data->event->title}}</span>
                        <div class="my-4">
                          <img src="{{QR($data->code)}}" alt="" class="img-fluid" width="80" height="80">
                        </div>
                        <div class="d-flex mb-3">
                          <h5 class="fw-bolder fs-6 mb-0">{{$general->cur_sym}} </h5>
                          <h2 class="fw-bolder fs-12 ms-2 mb-0">{{@number_format($v['price'],2)}}</h2>
                          <span class="ms-2 fs-4 d-flex align-items-center">/seat</span>
                        </div>
                        <ul class="list-unstyled mb-7">
                            <li class="d-flex align-items-center gap-2 py-2">
                             <i class="ti ti-check text-primary fs-4"></i>
                             <span class="text-dark">{{$v['benefits']}}</span>
                           </li>
                           <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">{{__(@$event->city->name)}} - {{__(@$event->location->name)}}</span>
                           </li>
                           <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Start: {{showDate($event->start_date)}} {{$event->start_time}}</span>
                          </li>
                          <li class="d-flex align-items-center gap-2 py-2">
                           <i class="ti ti-check text-primary fs-4"></i>
                           <span class="text-dark">End: {{showDate($event->end_date)}} {{$event->end_time}}</span>
                         </li>
 
                        </ul>
                        <button class="btn btn-primary btn-sm" onclick="printDiv('{{$data->code}}')">Print Ticket</button>
                      </div>
                    </div>
                  </div>
 
                @endforeach
                
                 
              </div>
        </div>
    </div>
    @endsection

    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-primary" href="{{ route('user.event.history') }}"> <i class="ti ti-printer"></i> @lang('Payment Log')</a>
    @endpush
    @push('script')
    <script>
    function printDiv(divId) 
    {
     var printContents = document.getElementById(divId).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
    }

    </script>
    @endpush
