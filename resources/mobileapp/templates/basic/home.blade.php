@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- loading section start -->
    <div class="onboarding-loader" id="onboardingLoader">
        <div class="rocket-img">
            <img class="rocket" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500"
                src="{{ asset($activeTemplateTrue . 'mobile/images/svg/rocket.svg')}}" alt="rocket">
        </div>
        <div class="flash-img">
            <img class="flash" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800"
                src="{{ asset($activeTemplateTrue . 'mobile/images/svg/flash.svg')}}" alt="flash">
        </div>
        <div class="logo-img">
            <img class="img-fluid" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="1000" src="{{ asset($activeTemplateTrue . 'mobile/images/white-piggy-bank-stacks-of-coins-and-credit-card-icon-on-transparent-background-3d-rendering-png.webp')}}" alt="logo">
        </div>
    </div>
    <!-- loading section end -->

    <!-- onboarding section start -->
    <section class="onboarding-section highlight se" id="onboardingBody">
        <div class="swiper onboarding">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="poster-wapper">
                        <div class="poster-box-chain" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="1700">
                            <span class="left-chain"></span>
                            <span class="right-chain"></span>
                        </div>
                        <div class="poster-box color1 box1" data-aos="fade-down" data-aos-duration="1000"
                            data-aos-delay="1700">
                            <h2>MANAGE</h2>
                            <img class="img-fluid top-line" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/lines.svg')}}" alt="lines">
                        </div>
                        <div class="poster-box color2 box2" data-aos="fade-right" data-aos-duration="2000"
                            data-aos-delay="2000">
                            <h2>YOUR</h2>
                        </div>
                        <div class="poster-box color1 box3" data-aos="fade-left" data-aos-duration="1000"
                            data-aos-delay="2500">
                            <h2>PAYMENTS</h2>
                        </div>
                        <div class="poster-box color2 box4" data-aos="fade-up" data-aos-duration="3000"
                            data-aos-delay="3000">
                            <h2>SMARTLY</h2>
                            <img class="img-fluid bottom-line" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/lines-fill.svg')}}" alt="lines">
                        </div>
                    </div>

                    <div class="custom-container">
                        <p>The best payment method connects your money to friends, family, brands, and experiences.</p>
                        <div class="d-flex justify-content-between align-items-center pb-3">
                            <a href="{{route('user.register')}}" class="btn btn-link mt-0 p-0">Signup</a>

                            <a href="{{route('user.login')}}">
                                <img class="img-fluid arrow" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/arrow-white.svg')}}" alt="arrow">
                            </a>
                        </div>
                    </div>
                </div>
                 
            </div>
        </div>
        </div>
    </section>
    <!-- onboarding section end -->
@endsection
