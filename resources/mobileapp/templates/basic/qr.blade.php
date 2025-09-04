@extends($activeTemplate . 'layouts.frontend')

@section('content')
<section>
    <div class="container">
        <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
        @csrf
        <div class="row justify-content-center">
        
            
            <div class="col-xl-6 col-lg-6">
                <div class="gray-simple rounded-2 py-3 px-3">
                    
                    <div class="square--80 circle bg-light-success text-success d-flex mb-4 mx-auto">
                        <i class="fa-solid fa-qrcode fs-1"></i>
                    </div>
                    
                    <div class="card-wrap text-center mb-4">
                        <h1 class="fs-2">{{$pageTitle}}</h1>
                        <p class="font--medium mb-0">Customer Name: {{$user->fullname}}</p>
                        <p class="font--medium">Customer Username: {{$user->username}}</p>
                    </div>

                    <div class="dash-y446 mt-3 mb-3">
                        <div class="alert alert-info d-flex mb-0" role="alert"><i class="ai-circle-info fs-xl"></i>
                            <div class="ps-2">Please enter your {{$general->site_name}} <b>Email Address </b> or <b>Username</b> in the corresponding field below then enter an <b>Amount</b> to pay as well as the <b>Transaction PIN</b> to the specified email/username and click on the <b>Make Pay</b> button to complete payment.<a class="text-info fw-semibold ms-1" href="#">Go to settings!</a></div>
                        </div>
                    </div>

                    <div class="row g-4 pb-4 pb-md-5 mb-3 mb-md-1">
                         
                        <div class="col-sm-12">
                            <label class="form-label fs-base">Email or Username</label>
                            <div class="position-relative"><i class="fa-regular fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input class="form-control form-control-lg ps-5" name="user" type="test" placeholder="Email address or username">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label fs-base">Amount <b>({{$general->cur_text}})</b></label>
                            <input class="form-control form-control-lg" name="amount" type="number" placeholder="0.00">
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label fs-base">Transaction PIN</label>
                            <div class="position-relative"><i class="fa-solid fa-lock position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input class="form-control form-control-lg ps-5" name="pin" type="tel" placeholder="****">
                            </div>
                        </div>
                         
                    </div>
                    
                    
                    <div class="d-nonse d-lg-block ">
                        <div class="form-check mb-4">
                            <input class="form-check-input" required type="radio" name="agree" type="checkbox" checked="" id="save-info">
                            <label class="form-check-label" for="save-info"><span class="text-muted">Your personal information will be used to process this payment, to support your experience on this site and for other purposes described in the </span><a class="fw-medium" href="#">privacy policy</a></label>
                        </div>
                        <button class="btn btn-lg btn-primary px-xl-5" type="submit">Make Payment</button>
                    </div>
                    
                </div>
            </div>
            
             
        </div> 
    </form>
            
    </div>
</section>
@endsection
