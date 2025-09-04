@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    @php
        $faqContent = getContent('faq.content', true);
        $faqElements = getContent('faq.element', null, false, true);
    @endphp 
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Contact Us</h2>
        <a href="#"></a>
      </div>
      <div class="row gy-3">
        <div class="col-3">
          <a href="{{$general->social_facebook}}">
            <div class="service-box">
              <i class="service-icon" data-feather="facebook"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Facebook</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="https://x.com/LTechNG_?t=2Bed2mxW3uU0AClJM6-RKw&s=09">
            <div class="service-box">
              <i class="service-icon" data-feather="twitter"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Twitter</h5>
          </a>
        </div>

        <div class="col-3">
          <a href="{{$general->social_instagram}}">
            <div class="service-box">
              <i class="service-icon" data-feather="instagram"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Instagram</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{ route('ticket.index') }}">
            <div class="service-box">
              <i class="service-icon" data-feather="mail"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Mail</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{$general->social_phone}}">
            <div class="service-box">
              <i class="service-icon" data-feather="smartphone"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Phone</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{$general->social_whatsapp}}">
            <div class="service-box">
              <h1><i class="service-icon fa fa-whatsapp"></i></h1>
            </div>
            <h5 class="mt-2 text-center dark-text">Whatsapp</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{$general->social_telegram}}">
            <div class="service-box">
              <h1><i class="service-icon fa fa-telegram"></i></h1>
            </div>
            <h5 class="mt-2 text-center dark-text">Telegram</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="{{$general->social_youtube}}">
            <div class="service-box">
              <h1><i class="service-icon fa fa-youtube"></i></h1>
            </div>
            <h5 class="mt-2 text-center dark-text">Youtube</h5>
          </a>
        </div>


         
      </div>
    </div>
  </section>
  <!-- service section end --><br>
    <section class="section-b-space">
        <div class="custom-container">
            <div class="help-center">
              <center>
                <h2 class="fw-semibold">{{ __(@$faqContent->data_values->heading) }}</h2>
                <p class="test-muted fs-6">{{ __(@$faqContent->data_values->sub_heading) }}</p>
              </center>
                <div class="accordion accordion-flush help-accordion" id="accordionFlushExample">
                    @forelse($faqElements as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne{{ $item->id }}">{{ __(@$item->data_values->question) }}</button>
                            </h2>
                            <div id="flush-collapseOne{{ $item->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                  {{ __(@$item->data_values->answer) }}</div>
                            </div>
                        </div>
                    @empty
                        {!! emptyData() !!}
                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!-- help section end -->
@endsection
