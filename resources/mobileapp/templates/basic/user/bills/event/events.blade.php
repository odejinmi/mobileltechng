@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row">
        <div class="col-12">


            <div class="card-body p-4 pb-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas" href="#offcanvasExample"
                    role="button" aria-controls="offcanvasExample">
                    <i class="ti ti-menu-2 fs-6"></i>
                  </a>
                  <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">@lang('Events')</h5>
                  <form class="position-relative">
                    <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                      placeholder="Search Product">
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                  </form>
                </div>
                <div class="row">
                  @forelse($events as $event)
                  <div class="col-sm-6 col-xl-4">
                    <div class="card hover-img overflow-hidden rounded-2">
                      <div class="position-relative">
                        <a href="{{route('user.event.view',encrypt($event->id))}}"><img src="{{getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])}}"
                            class="card-img-top rounded-0" alt="..."></a>
                        <a href="javascript:void(0)"
                          class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Buy Ticket"><i
                            class="ti ti-basket fs-4"></i></a>
                      </div>
                      <div class="card-body pt-3 p-4">
                        <h6 class="fw-semibold fs-4">{{__($event->title)}}</h6>
                        <div class="d-flex align-items-center justify-content-between">
                          <h6 class="fw-semibold fs-4 mb-0">{{__(@$event->city->name)}} - {{__(@$event->location->name)}}</h6>
                           
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  {!!emptyData2()!!}
                  @endforelse
                   
                </div>
              </div>


 
    @endsection

    @push('breadcrumb-plugins')
    @endpush 