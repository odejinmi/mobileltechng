

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>{{ $general->siteName($pageTitle ?? '') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="{{$general->site_name}} - Receipt" name="description" />
  <meta content="{{$general->site_name}}" name="author" />
  <link rel="stylesheet" href="{{url('/')}}/assets/receipt/css/style.css">
  <style>
    .badge {
display: inline-block;
padding: 2px 6px;
font-size: 12px;
font-weight: bold;
color: #fff;
background-color: #337ab7;
border-radius: 2px;
margin-right:1em;
} 
.success {
background-color: #7af897; /* Green */
} 
.danger {
background-color: #f09ea7; /* Red */
} 

</style>
<style> 
.alert {
	position: relative;
	padding: .75rem 1.25rem;
	margin-bottom: 1rem;
	border: 1px solid transparent;
	border-radius: .25rem
}

.alert-heading {
	color: inherit
}

.alert-link {
	font-weight: 700
}

.alert-dismissible {
	padding-right: 4rem
}

.alert-dismissible .close {
	position: absolute;
	top: 0;
	right: 0;
	padding: .75rem 1.25rem;
	color: inherit
}

.alert-primary {
	color: #004085;
	background-color: #cce5ff;
	border-color: #b8daff
}
 
.alert-danger {
	color: #721c24;
	background-color: #f8d7da;
	border-color: #f5c6cb
} 
</style>
</head>
@php
$contactContent = getContent('contact.content', true);
$addressContent = getContent('address.content', true);
$user = auth()->user();
@endphp
<body>
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
        <div class="cs-invoice_in" id="download_section">
            <div class="cs-invoice_head cs-type1 cs-mb25 column border-bottom-none">
                <div class="cs-invoice_left w-70 display-flex">
                    <div class="cs-logo cs-mb5 cs-mr20"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="50" alt="Logo"></div>
                    <div class="cs-ml22">
                        <div class="cs-invoice_number cs-primary_color cs-mb0 cs-f16">
                            <b class="cs-primary_color">{{$general->site_name}}</b>
                        </div>
                        <div
                            class="cs-invoice_number cs-primary_color cs-mb0 cs-f16 display-flex space-between  gap-20">
                            <p>
                              {{ __(@$addressContent->data_values->address) }}<br>
                              {{ __(@$addressContent->data_values->email) }} <br>
                              {{ __(@$addressContent->data_values->phone) }}
                            </p>
                        </div>
                         
                    </div>
                </div>
                <div class="cs-invoice_right cs-text_right">
                     
                    <div
                        class="cs-invoice_number cs-primary_color cs-mb0 cs-f16  display-flex justify-content-flex-end">
                        <p class="cs-primary_color cs-mb0"><b>Start Date:</b></p>
                        <p class="cs-mb0">{{$startDate}}</p>
                    </div>
                    <div
                        class="cs-invoice_number cs-primary_color cs-mb0 cs-f16  display-flex justify-content-flex-end">
                        <p class="cs-primary_color cs-mb0"><b>End Date:</b></p>
                        <p class="cs-mb0">{{$endDate}}</p>
                    </div>
                </div>
            </div>
            <div class="display-flex cs-text_center">
                <div class="cs-border-1"></div>
                <h5 class="cs-width_12 cs-dip_green_color">STATEMENT OF ACCOUNT</h5>
                <div class="cs-border-1"></div>
            </div>

            <div class="cs-invoice_head cs-mb10 ">
                <div class="cs-invoice_left cs-mr97">
                    <b class="cs-primary_color">Customer Name:</b>
                    <p class="cs-mb8">{{Auth::user()->fullname}}</p>
                    <p><b class="cs-primary_color cs-semi_bold">Customer Email:</b> <br>{{Auth::user()->email}}</p>
                </div>
                <div class="cs-invoice_right">
                    <b class="cs-primary_color">Billing Address:</b>
                    <p>
                      {{Auth::user()->address->address}} <br />  {{Auth::user()->address->state}},<br /> {{Auth::user()->address->country}}
                    </p>
                </div>
                 
            </div>
            <div class="cs-border"></div>
            <ul class="cs-grid_row cs-col_3 cs-mb0 cs-mt20">
                <li>
                    <p class="cs-mb20"><b class="cs-primary_color">Account Number:</b> <br><span
                            class="cs-primary_color"> {{Auth::user()->nuban_ref}}</span></p>
                </li>
                <li>
                    <p class="cs-mb20"><b class="cs-primary_color"> </b> <span
                            class="cs-primary_color"> </span></p>
                </li>
                <li>
                    <p class="cs-mb20"><b class="cs-primary_color">Issued Date:</b><br> <span
                            class="cs-primary_color">{{ showDateTime(now()) }}</span></p>
                </li>
            </ul>
            <div class="cs-border cs-mb30"></div>
            <div class="cs-table cs-style2 cs-f12">
                <div class="cs-round_border">
                    <div class="cs-table_responsive">
                        <table>
                            <thead>
                                <tr class="cs-focus_bg">
                                    <th class="cs-width_1 cs-semi_bold cs-primary_color">Date</th>
                                    <th class="cs-width_1 cs-semi_bold cs-primary_color">TRANS ID.
                                    </th>
                                    <th class="cs-width_2 cs-semi_bold cs-primary_color">Narration</th>
                                    <th class="cs-width_1 cs-semi_bold cs-primary_color">Amount</th>
                                    <th class="cs-width_1 cs-semi_bold cs-primary_color">Credit</th>
                                    <th class="cs-width_1 cs-semi_bold cs-primary_color">Debit</th>
                                    </th> 
                                    <th class="cs-width_1 cs-semi_bold cs-primary_color cs-text_right">Balance After</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($transactions as $data)
                                <tr>
                                    <td>{{ showDate($data->created_at) }}</td>
                                    <td>{{$data->trx}}</td>
                                    <td>{{$data->details}}</td>
                                    <td>{{$general->cur_sym}}{{number_format($data->amount,2)}}</td>
                                    <td>@if($data->trx_type == '+')<label class="badge success">Credit</label> @endif</td>
                                    <td>@if($data->trx_type != '+')<label class="badge danger">Debit</label> @endif</td>
                                    <td class="cs-text_right cs-primary_color">{{$general->cur_sym}}{{number_format($data->post_balance,2)}}</td>
                                </tr>
                                @empty
                                <div class="alert alert-danger" role="alert">
                                  <div class="ui-alert-inner"><strong>Hi there!</strong> You do not have any transaction log for the selected date.</div>
                                </div>
                                @endforelse
                                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="cs-table cs-style2 cs-mt20">
                <div class="cs-table_responsive">
                    <table>
                        <tbody>
                            <tr class="cs-table_baseline">
                                <td class="cs-width_6 cs-primary_color"> This statement of account as generated remains a property of {{$general->site_name}} and can be tendered on request by the authorized personnel.

                                </td>
                                <td class="cs-width_3 cs-text_right">
                                    <p class="cs-mb5 cs-mb5 cs-f15 cs-primary_color cs-semi_bold">Total Credit:</p>
                                    <p class="cs-primary_color cs-bold cs-f16 cs-mb5 ">Total Debit:</p> 
                                    <p class="cs-border border-none"></p>
                                    <p class="cs-primary_color cs-bold cs-f16 cs-mb5 ">Total Transaction:</p>
                                </td>
                                <td class="cs-width_3 cs-text_rightcs-f16">
                                    <p class="cs-mb5 cs-mb5 cs-text_right cs-f15 cs-primary_color cs-semi_bold">
                                      {{$general->cur_sym}}{{number_format($credit,2)}}
                                    </p>
                                    <p class="cs-primary_color cs-bold cs-f16 cs-mb5 cs-text_right">{{$general->cur_sym}}{{number_format($debit,2)}}</p>
                                     <p class="cs-border"></p>
                                    <p class="cs-primary_color cs-bold cs-f16 cs-mb5 cs-text_right">{{$general->cur_sym}}{{number_format($transactionvalue,2)}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="cs-invoice_btns cs-hide_print">
            <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <path
                        d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                        fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                    <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none"
                        stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                    <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                        stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                    <circle cx="392" cy="184" r="24" />
                </svg>
                <span>Print</span>
            </a>
            <button id="download_btn" class="cs-invoice_btn cs-color2">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Download</title>
                    <path
                        d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32" />
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32" d="M176 272l80 80 80-80M256 48v288" />
                </svg>
                <span>Download</span>
            </button>
        </div>
    </div>
</div>

  <script src="{{url('/')}}/assets/receipt/js/jquery.min.js"></script>
  <script src="{{url('/')}}/assets/receipt/js/jspdf.min.js"></script>
  <script src="{{url('/')}}/assets/receipt/js/html2canvas.min.js"></script>
  <script src="{{url('/')}}/assets/receipt/js/main.js"></script>
</body>
</html>
