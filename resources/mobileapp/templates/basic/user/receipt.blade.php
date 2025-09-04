

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
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">
            <p class="cs-invoice_number cs-primary_color cs-mb0 cs-f16"><b class="cs-primary_color">Invoice No:</b> #{{$transaction->trx}}</p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="40" alt="Logo"></div>
          </div>
        </div>
        <div class="cs-invoice_head cs-mb10">
          <div class="cs-invoice_left">
            <b class="cs-primary_color">Invoice To:</b>
            <p>
              {{Auth::user()->fullname}} <br>
              {{Auth::user()->email}}
            </p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <b class="cs-primary_color">{{$general->site_name}}</b>
            <p>
              {{ __(@$addressContent->data_values->address) }}<br>
              {{ __(@$addressContent->data_values->email) }} <br>
              {{ __(@$addressContent->data_values->phone) }}
            </p>
          </div>
        </div>
        <ul class="cs-list cs-style2">
          <li>
            <div class="cs-list_left">Client ID: <b class="cs-primary_color cs-semi_bold ">{{Auth::user()->username}}</b></div>
            <div class="cs-list_right">Balance After: <b class="cs-primary_color cs-semi_bold ">{{$general->cur_sym}}{{number_format($transaction->post_balance,2)}}</b></div>
          </li>
          <li>
            <div class="cs-list_left">Invoice Date: <b class="cs-primary_color cs-semi_bold ">{{ showDate($transaction->created_at) }}</b></div>
            <div class="cs-list_right">Invoice Time: <b class="cs-primary_color cs-semi_bold ">{{ showTime($transaction->created_at) }}</b></div>
          </li> 
        </ul>
        <div class="cs-table cs-style2">
          <div class="">
            <div class="cs-table_responsive">
              <table>
                <thead>
                  <tr class="cs-focus_bg">
                    <th class="cs-width_5 cs-semi_bold cs-primary_color">Description</th>
                    <th class="cs-width_5 cs-semi_bold cs-primary_color"></th>
                    <th class="cs-width_2 cs-semi_bold cs-primary_color cs-text_right">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td class="cs-width_5" colspan="2">Status</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">
                      <label class="badge success">Success</label>
                    </td>
                  </tr>
                  <tr>
                    <td class="cs-width_5" colspan="2">Type</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">
                      <label class="badge @if ($transaction->trx_type == '+') success @else danger @endif">@if ($transaction->trx_type == '+') Credit @else Debit @endif</label>
                    </td>
                  </tr>
                  <tr>
                    <td class="cs-width_5" colspan="2">Service</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">
                      <label class="badge">{{$transaction->remark}}</label>
                    </td>
                  </tr>

                  <tr>
                    <td class="cs-width_5" colspan="2">Remark</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">
                      <label class="whitespace-pre">{{$transaction->details}}</label>
                    </td>
                  </tr>
                  <tr>
                    <td class="cs-width_5" colspan="2">Amount</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">{{ __($general->cur_sym) }}{{ showAmount($transaction->amount,2) }}</td>
                  </tr>
                  <tr class="cs-focus_bg cs-no_border">
                    <td class="cs-width_5 cs-text_right cs-primary_color cs-semi_bold" colspan="2">Total Fee:</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color cs-semi_bold">{{ __($general->cur_sym) }}{{ showAmount($transaction->fee) }}</td>
                  </tr>
                  <tr class="cs-no_border cs-table_baseline">
                    <td class="cs-width_5">This transaction was logged on: <br><b class="cs-primary_color">{{ showDateTime($transaction->created_at) }}</b></td>
                    <td class="cs-width_5 cs-text_right cs-primary_color cs-bold cs-f16">Total Amount:</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color cs-bold cs-f16">{{ __($general->cur_sym) }}{{ showAmount($transaction->amount+$transaction->fee,2) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="cs-note">
          <div class="cs-note_left">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </div>
          <div class="cs-note_right">
            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
            <p class="cs-m0">Thank you for your transaction. The receipt serves as an evidence of the transaction.</p>
          </div>
        </div><!-- .cs-note -->
      </div>
      <div class="cs-invoice_btns cs-hide_print">
        <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24"/></svg>
          <span>Print</span>
        </a>
        <button id="download_btn" class="cs-invoice_btn cs-color2">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Download</title><path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288"/></svg>
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
