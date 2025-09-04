@extends('admin.layouts.app')
@section('panel')
<!-- row opened -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{$currency->name}}  Currency Manager</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-xl-12 col-md-12 col-sm-12">
													 
													<div class="card-body">
														<form action="{{route('admin.crypto.postcoin',$currency->id)}}" class="form-horizontal" method="POST">
                                                        {{csrf_field()}}
														    <div class="form-group mb-4">
															<small>{{$currency->name}} Wallet Address <b>(For Manual Payments Only)</b></small>
																<input type="text" class="form-control" value="{{$currency->wallet_address}}" name="wallet_address" placeholder="Wallet Address ">
															</div>
															<div class="form-group mb-4">
																<small>{{$currency->account_details}} Account Details Address <b>(Manual Payments For Crypto Buying Customers Only)</b></small>
																	<textarea type="text" class="form-control" value="{{$currency->account_details}}" name="account_details" placeholder="Account Details ">{{$currency->account_details}}</textarea>
																</div>
															<div class="form-group mb-4">
															<small>{{$currency->name}} Wallet API Key <b>(For API Auto Payments Only)</b></small>
																<input type="text" class="form-control" value="{{$currency->apikey}}" name="apikey" placeholder="API Wallet Key">
															</div>
															<div class="form-group  mb-4">
															<small>{{$currency->name}} Wallet Password <b>(For API Auto Payments Only)</b></small>
																<input type="text" class="form-control" value="{{$currency->apipass}}" name="apipass" placeholder="API Wallet Password">
															</div>
															<div class="form-group  mb-4">
															<small>@lang('Merchant Transaction Fee') <b>(%)</b></small>
																<input type="text" class="form-control" value="{{$currency->merchant_trx_fee}}" name="merchant_trx_fee" placeholder="Merchant Fee">
															</div>

															<div class="form-group  mb-4">
																<small>@lang('Currency Swap Rate') <b>(1 = USD = {{$currency->swap_rate}} {{$general->cur_text}})</b></small>
																	<input type="text" class="form-control"  value="{{$currency->swap_rate}}" name="swap_rate" placeholder="Swap Rate">
															</div>

															<div class="form-group  mb-4">
																<small>@lang('Currency Buy Rate') <b>(1 = USD = {{$currency->buy_rate}} {{$general->cur_text}})</b></small>
																	<input type="text" class="form-control"  value="{{$currency->buy_rate}}" name="buy_rate" placeholder="Buy Rate">
															</div>

															<div class="form-group  mb-4">
																<small>@lang('Currency Sell Rate') <b>(1 = USD = {{$currency->sell_rate}} {{$general->cur_text}})</b></small>
																	<input type="text" class="form-control"  value="{{$currency->sell_rate}}" name="sell_rate" placeholder="Sell Rate">
															</div>

															<div class="form-group  mb-4">
															<small>@lang('Service Provider Transaction Fee') <b>({{$currency->symbol}})</b></small>
																<input type="text" class="form-control" value="{{$currency->api_trx_fee}}" name="api_trx_fee" placeholder="API Transaction Fee">
															</div>
															<div class="form-group  mb-4">
															<small>@lang('Service Provider Processing Fee') <b>(%)</b></small>
																<input type="text" class="form-control" value="{{$currency->api_processing_fee}}" name="api_processing_fee" placeholder="API Processing Fee">
															</div>
															<div class="form-group  mb-4">
															<small>@lang('Minimum Transaction') <b>(USD)</b></small>
																<input type="text" class="form-control" value="{{$currency->maximum_amount}}" name="maximum_amount" placeholder="Max Amount">
															</div>

															<div class="form-group  mb-4">
															<small>@lang('Minimum Transaction') <b>(USD)</b></small>
																<input type="text" class="form-control" value="{{$currency->minimum_amount}}" name="minimum_amount" placeholder="Min Amount">
															</div>
															@can(['admin.crypto.edit*'])
															<div class="form-group mb-0 mt-3 justify-content-end">
																<div>
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</div>
															@endcan
														</form>
													</div>
											</div>


										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>
@endsection
