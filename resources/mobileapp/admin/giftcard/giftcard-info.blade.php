@extends('admin.layouts.app')

@section('panel')
    <script>
        function goBack() {
            window.history.back()
        }
    </script>

    <div class="page-content">
        <div class="container">

            <div class="col-lg-12 col-12">
                <div class="card card-user-timeline">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <i data-feather="list" class="user-timeline-title-icon"></i>
                      <h4 class="card-title">Transaction Details</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="timeline ms-50">
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Transaction Date</h6>
                          <div class="d-flex align-items-center">
                            <h6 class="more-info mb-0">{{ date('d M Y', strtotime($exchange->created_at)) }}</h6>
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Transaction Status</h6>
                           <div class="d-flex align-items-center">
                             
                            <div class="more-info">
                            @if ($exchange->status == 1)
                                <span class="badge bg-success">Success</span>
                            @elseif($exchange->status == 2)
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif                            
                          </div>
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Customer</h6>
                          <p></p>
                          <div class="avatar-group">
                            {{ isset($exchange->user->username) ? $exchange->user->username : 'No User Available' }}
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Amount</h6>
                          <p class="mb-0">{{ number_format($exchange->amount, 2) }} {{ $exchange->country }}</p>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Card Type</h6>
                          <p class="mb-0">{{ App\Models\Giftcard::whereId($exchange->card_id)->first()->name }}</p>
                          <p class="mb-0">{{ App\Models\Giftcardtype::whereId($exchange->currency)->first()->name }}</p>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Value in {{ $general->cur_text }}</h6>
                          <p class="mb-0">{{ $general->cur_sym }}{{ number_format($exchange->amount * $exchange->rate, 2) }}</p>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Transaction ID</h6>
                          <p class="mb-0">{{ $exchange->trx }}</p>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-primary timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <h6>Giftcard Number</h6>
                          <p class="mb-0">{{ isset($exchange->code) ? $exchange->code : 'Not Available Fot This Trade' }}</p>
                        </div>
                      </li>
                      @if ($exchange->image)
				<li class="timeline-item"><br>
					<div class="data-details-head">Front View</div>
					<div class="data-doc-item data-doc-item-lg">
						<div class="data-doc-image"><img  width="40"  src="{{ asset('assets/images/giftcards/' . $exchange->image) }}"
								alt="passport"></div>
						<ul class="data-doc-actions">
							<li><a href="{{ asset('assets/images/giftcards/' . $exchange->image) }}" download><em
										class="ti ti-import"></em></a></li>
						</ul>
					</div>
				</li>
			@endif
			@if ($exchange->image2)
				<li class="timeline-item"><br>
					<div class="data-details-head">Back View</div>
					<div class="data-doc-item data-doc-item-lg">
						<div class="data-doc-image"><img width="40" src="{{ asset('assets/images/giftcards/' . $exchange->image2) }}"
								alt="passport"></div>
						<ul class="data-doc-actions">
							<li><a href="{{ asset('assets/images/giftcards/' . $exchange->image2) }}" download><em
										class="ti ti-import"></em></a></li>
						</ul>
					</div>
				</li>
			@endif
			@if ($exchange->status == 0)
				<li class="timeline-item">
					 
					<div class="data-details-des"><span>
						   
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#modalapprove{{$exchange->trx_type}}">Approve</button>
							<button type="button" class="btn btn-danger" data-bs-toggle="modal"
								data-bs-target="#modaldecline{{$exchange->trx_type}}">Decline</button>
						</span></div>
				</li>
			@endif
                    </ul>
                  </div>
                </div>
              </div>
              <!--/ Timeline Card -->

            
        </div><!-- .container -->
    </div>



    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="modalapprovesell">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Approve Giftcard Trade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to approve this giftcard trade. This action cannot be reversed</p>
                </div>
                <div class="modal-footer bg-light">
                    <a href="{{ route('admin.appgift', $exchange->id) }}"><em class="ti ti-check-box"></em> Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modaldeclinesell">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Decline Giftcard Trade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to decline this giftcard trade. This action cannot be reversed</p>
                </div>
                <div class="modal-footer bg-light">
                    <a href="{{ route('admin.rejgift', $exchange->id) }}"><em class="ti ti-check-box"></em> Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Buy Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="modalapprovebuy">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Approve Giftcard PurchaseTrade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to approve this giftcard trade. This action cannot be reversed</p>
                        <form class="form-validate is-alter" role="form" action="{{ route('admin.appgift', $exchange->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if($exchange->type == 'Digital')
                        <div class="form-group">
                            <label class="form-label" for="pin">Giftcard Number</label>
                            <div class="form-control-wrap">
                                <input type="text" name="pin" class="form-control" id="pin" required>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <label class="form-label" for="front">Upload Gift Front View Image</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" name="front" id="front" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="front">Upload Gift Back View Image</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" name="back" id="back" required>
                            </div>
                        </div>
                        @endif 
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline btn-primary btn-sm">Proceed</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <a href="#" data-bs-dismiss="modal"><em class="ti ti-trash"></em> Close</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modaldeclinebuy">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Decline Giftcard Purchase Trade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to decline this giftcard trade. This action cannot be reversed</p>
                    <form class="form-validate is-alter" role="form" action="{{ route('admin.rejgift', $exchange->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Toggle the switch below to refund trade money of <b class="text-success">{{ $general->cur_sym }}{{ number_format($exchange->pay,2) }}</b> back to customer's wallet</label>
                            <ul class="custom-control-group g-3 align-center">
                                <li>
                                    <div class="input-item">
                                        <input type="checkbox" name="refund" class="input-switch  input-switch-sm" id="refund">
                                        <label for="refund"></label>
                                    </div> 
                                    
                                </li> 
                            </ul>
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline btn-danger btn-sm">Proceed</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <a href="#" data-bs-dismiss="modal"><em class="ti ti-trash"></em> Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
