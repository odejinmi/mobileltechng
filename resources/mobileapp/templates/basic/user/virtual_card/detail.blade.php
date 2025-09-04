@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <!-- File export -->
    
    <!-- card start -->
  <section class="section-b-space">
      
      @if(session('success'))
                                <div class="alert alert-success">
                                    @if(is_array(session('success')))
                                        {!! implode('<br>', session('success')) !!}
                                    @else
                                        {{ session('success') }}
                                    @endif
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    @if(is_array(session('error')))
                                        {!! implode('<br>', session('error')) !!}
                                    @else
                                        {{ session('error') }}
                                    @endif
                                </div>
                            @endif
                            
    <div class="custom-container"> 
      <div class="card-box">
        <div class="card-details">
          <div class="d-flex justify-content-between">
            <h5 class="fw-semibold">Card Balance</h5>
            <img src="{{ asset($activeTemplateTrue . 'mobile/images/svg/ellipse.svg')}}" alt="ellipse" />
          </div>

          <h1 class="mt-2 text-white">${{ number_format($cardDetails['balance'] ?? 0, 2) }}</h1>

          <div class="amount-details">
            <div class="amount w-50 text-start">
              <div class="d-flex align-items-center justify-content-start">
                <h5>{{ $cardDetails['card_holder_name'] ?? 'N/A' }}</h5>
              </div>
              <h3 class="text-white"> {{ isset($cardDetails['card_number']) ? chunk_split($cardDetails['card_number'], 4, '  ') : 'N/A' }}</h3>
            </div>
            <div class="amount w-50 text-end border-0">
              <div class="d-flex align-items-center justify-content-end">
                <h5>Exp:</h5>
              </div>
              <h3 class="text-white">{{ @$cardDetails['expiry'] ?? 'N/A' }}</h3>
            </div>
          </div>
        </div>
        <a href="#add-money" class="add-money theme-color" data-bs-toggle="modal">+ Fund Card</a>
      </div>
    </div>
  </section>
  <!-- card end -->
  
  
  
  
  <!-- notification receive money section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="receive-money-box">
        <div class="receive-money-header">
          <div class="receive-money-img">
            <i class="icon" data-feather="credit-card"></i>
          </div>
          <h2>Card Details</h2>
        </div>
        <div class="receive-money-details">
          <ul class="details-list">
            <li>
              <h3 class="fw-normal dark-text">Card Number</h3>
              <h3 class="fw-normal theme-color">{{ @$cardDetails['card_number'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Card CVV</h3>
              <h3 class="fw-normal light-text"> {{ @$cardDetails['cvv'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Card Type</h3>
              <h3 class="fw-normal light-text">{{ @$cardDetails['card_type'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Card Expiry</h3>
              <h3 class="fw-normal light-text">{{ @$cardDetails['expiry'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Card Brand</h3>
              <h3 class="fw-normal light-text">{{ @$cardDetails['card_brand'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Card Status</h3>
              <h3 class="fw-normal light-text"> {{ @$cardDetails['card_status'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Card Reference</h3>
              <h3 class="fw-normal light-text">{{ @$cardDetails['reference'] ?? 'N/A' }}</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Street</h3>
              <h3 class="fw-normal light-text">3401 N. Miami, Ave. Ste 230</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">State</h3>
              <h3 class="fw-normal light-text">Florida</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">City</h3>
              <h3 class="fw-normal light-text">Miami</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Zip</h3>
              <h3 class="fw-normal light-text">33127</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Country</h3>
              <h3 class="fw-normal light-text">USA</h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Date Created</h3>
              <h3 class="fw-normal light-text">{{ @$cardDetails['card_created_date'] ?? 'N/A' }}</h3>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- notification receive money section starts -->

  <!-- Buy & Sell history section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Transaction History</h2>
      </div>

      <div class="row gy-3">
           @if(isset($cardTransactions->response->card_transactions))
                                                @foreach($cardTransactions->response->card_transactions as $transaction)
        <div class="col-12">
          <div class="transaction-box">
            <a href="#" class="d-flex gap-3">
              <div class="transaction-image color3">
                <img class="img-fluid icon" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="bitcoins" /><br>
                
              </div>
              <span><small>{{ $transaction->narrative }}</small></span>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5>{{ $transaction->type }}</h5>
                  <h3 class="dark-text">${{ number_format(($transaction->centAmount ?? 0) / 100, 2) }} 
                  </h3>
                  
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text">{{ date('Y-m-d H:i:s', strtotime($transaction->createdAt)) }}</h5>
                  <h5 class="@if( $transaction->status == 'success' ) success-color @else  error-color @endif">{{ $transaction->status }} 
                  </h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
                                            @else
                                                     <td colspan="6">No transactions found.</td>
                                            @endif
        
    </div>
</section>
  
  <!-- add money modal start -->
  <div class="modal add-money-modal fade" id="add-money" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Fund Card</h2>
        </div>
            <form action="{{ route('user.post_fund.card', $vcards->card_id) }}" method="POST">
             @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="inputamount" class="form-label mb-2">Amount in USD</label>
            <div class="form-input">
              <input type="number" name="amount" class="form-control" id="inputamount" />
            </div>
            <p style="color: orange;">Rate #{{ $general->virtualcard_usd_rate }} = $1</p>

          </div>
          <button type="submit" class="btn theme-btn successfully w-100">Deposit</button>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
        </form>
      </div>
    </div>
  </div>
  <!-- add money modal end -->

  
@endsection
