@php
    $faqContent = getContent('faq.content', true);
    $faqElements = getContent('faq.element', null, false, true);
@endphp
<!-- ============================ FAQ's Start ================================== -->
<section class="gray-simple">
    <div class="container">
        
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center">
                    <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span>@lang('Check Our FAQ\'s')</span></div>
                    <h2 class="mb-1">{{ __(@$faqContent->data_values->heading) }}</h2>
                    <p class="test-muted fs-6">{{ __(@$faqContent->data_values->sub_heading) }}</p>
                  </div>
            </div>
        </div>
        
        <div class="row justify-content-between align-items-start g-4">
                <div class="accordion" id="PanelsStayOpen">
                    @forelse($faqElements as $item)
                    <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne{{$item->id}}" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne{{$item->id}}">
                                {{ __(@$item->data_values->question) }}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne{{$item->id}}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                {{ __(@$item->data_values->answer) }}
                            </div>
                        </div>
                    </div>
                    @empty
                    {!!emptyData()!!}
                    @endforelse
                </div>
        </div>
        
    </div>
</section>
<div class="clearfix"></div>
<!-- ============================ FAQ's End ================================== -->


 