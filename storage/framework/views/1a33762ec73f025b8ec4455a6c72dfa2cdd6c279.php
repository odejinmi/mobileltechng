<?php $__env->startSection('panel'); ?>

<section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details">
          <div class="d-block w-75">
            <h5 class="fw-semibold" id="USDBALANCE">Fiat Balance</h5>
            <h2 class="mt-2"><?php echo e($wallet->balance); ?><small><?php echo e(strToUpper($coin->symbol)); ?></small></h2>
          </div>
          <div class="price-difference">
            <h6 >
                <img class="img-fluid icon" width="40" src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e(@$coin->image); ?>" alt="bitcoins" />

            </h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- card end -->
  <section>
    <div class="custom-container">
      <div class="chart mb-3">
          
        <div style="width: 250spx; max-width:100% height:220px;  overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:220px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px;"><div style="height:200px; padding:0px; margin:0px; max-width:100%"><iframe src="https://widget.coinlib.io/widget?type=single_v2&theme=light&coin_id=<?php echo e($coin->code); ?>&pref_coin_id=1505" width="350"  height="196px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="pointer-events: none; max-width:100%; border:0;margin:0;padding:0;line-height:14px;"></iframe></div></div>
    </div>
      </div>
    </div>
  </section>
  <!-- categories section starts -->
  <section class="categories-section section-b-space">
    <div class="custom-container">
      <ul class="categories-list">
        <li data-bs-toggle="modal" data-bs-target="#send-coin"> 
          <a href="#">
            <div class="categories-box">
              <i class="categories-icon" data-feather="arrow-up"></i>
            </div>
            <h5 class="mt-2 text-center">Send</h5>
          </a>
        </li>
        <li  data-bs-toggle="modal" data-bs-target="#receive-coin">
          <a href="#">
            <div class="categories-box">
              <i class="categories-icon" data-feather="arrow-down"></i>
            </div>
            <h5 class="mt-2 text-center">Receive</h5>
          </a>
        </li> 

        <li data-bs-toggle="modal" data-bs-target="#swap-coin">
          <a href="#">
            <div class="categories-box">
              <i class="iconsax categories-icon" data-icon="repeat"></i>
            </div>
            <h5 class="mt-2 text-center">Swap</h5>
          </a>
        </li>
      </ul>
    </div>
  </section>
  <!-- categories section end -->
 
  <!-- Transaction section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Transaction History</h2>
        <a href="<?php echo e(route('user.crypto.wallet.trx', $wallet->address)); ?>">See all</a>
      </div>

      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="<?php echo e($data['explorer_url']); ?>" class="d-flex gap-3">
              <div class="transaction-image color1">
                <img class="img-fluid icon" src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e(@$coin->image); ?>" alt="bitcoins" />
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e($coin->name); ?></h5>
                  <h3 class="<?php if($data['type'] == 'receive'): ?> success-color  <?php else: ?>  error-color  <?php endif; ?>">$<?php echo e(number_format($data->usd,2)); ?></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class=" <?php if($data['type'] == 'receive'): ?> success-color  <?php else: ?>  error-color  <?php endif; ?>"><?php echo e(@strToUpper($data['type'])); ?></h5>
                  <h5 class=" <?php if($data['type'] == 'receive'): ?> success-color  <?php else: ?>  error-color  <?php endif; ?>"><?php echo e(showDate($data['date'])); ?></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php echo emptyData2(); ?>

        <?php endif; ?> 
      </div>
    </div>
  </section>
  <!-- Transaction section end -->


  <!-- Send Coin modal starts -->
  <div class="modal add-money-modal fade" id="send-coin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title"><?php echo app('translator')->get('Send'); ?> <?php echo e($coin->name); ?></h2>
        </div>
        <div class="modal-body">
            <section class="pay-money section-b-space">

         
          <div class="form-group">
            <input type="text" class="form-control form-control-solid" onkeyup="validatewallet()"  placeholder="Enter wallet address" id="address" />
            <div id="getwallet"></div>
          </div>

          <div class="form-group">
            <div class="form-group mt-3">
                <div class="form-input" id="">
                    <input type="number" onkeyup="exchange()" placeholder="0.00USD" disabled name="amount" placeholder="$0.00" class="form-control amount"
                        id="amount">
                </div>
            </div>

            <div id="getrate"></div>
            </div>
            <div id="submitting"></div>

            </section>
 

          <a href="#" onclick="sendcoin()" id="submit" disabled  class="btn theme-btn successfully w-100">Send</a>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Send modal end -->

  <!-- Receive Coin modal starts -->
  <div class="modal add-money-modal fade" id="receive-coin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title"><?php echo app('translator')->get('Receive'); ?> <?php echo e($coin->name); ?></h2>
        </div>
        <div class="modal-body">
            <section class="pay-money section-b-space">

         
          <div class="form-group">
            <img src="<?php echo e($wallet->qrcode); ?>" class=" w-200px" alt="" />
          </div>

          <div class="element-list">
          <div class="alert theme-alert w-100" role="alert">
            Please scan the QR code above or copy the wallet address below
          </div>
          </div>

          <div class="form-group"  onclick="myFunction()" >
            <div class="form-group mt-1">
                <div class="form-inputs" id="">
                    <input type="text"id="walletaddress" value="<?php echo e($wallet->address); ?>" readonly class="form-control reasons">
                </div>
            </div> 
            </section>
 

        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Send modal end -->

  <!-- Send Coin modal starts -->
  <div class="modal add-money-modal fade" id="swap-coin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title"><?php echo app('translator')->get('Swap'); ?> <?php echo e($coin->name); ?></h2>
        </div>
        <div class="modal-body">
            <section class="pay-money section-b-space">
 

          <div class="form-group">
            <div class="form-group mt-3">
                <div class="form-input" id="">
                    <input type="number"  onkeyup="swap()" placeholder="0.00USD" name="amount" placeholder="$0.00" class="form-control amount"
                        id="swapamount">
                </div>
            </div>

            <div id="getswaprate"></div>
            </div>
            <div id="submittingswap"></div>

            </section>
 

          <a href="#" onclick="swapcoin()" id="swapbutton" disabled  class="btn theme-btn successfully w-100"> <?php echo app('translator')->get('Swap'); ?> <?php echo e($coin->name); ?></a>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Send modal end -->
  <!-- successful modal start -->
  <div class="modal successful-modal fade" id="done" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="doneheader"></h2>
            </div>
            <div class="modal-body">
                <div class="done-img">
                    <div id="doneimage"></div>
                </div>
                <h2 id="sentamount"></h2>
                <h3 id="sentmessage"></h3>
            </div>
            <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                <i class="icon" data-feather="x"></i>
            </button>
        </div>
    </div>
</div>
<!-- successful modal end -->


    <?php $__env->startPush('script'); ?>
        <script>
            function myFunction() {
                var copyText = document.getElementById("walletaddress");
                copyText.select();
                copyText.setSelectionRange(0, 99999); /*For mobile devices*/
                document.execCommand("copy");
                SlimNotifierJs.notification('success', 'Wallet Address Copied');

            }
        </script>
        <script>
            const coins = async () => {
                await fetch('https://data.messari.io/api/v1/assets')
                    .then(data => data.json())
                    .then(res => {
                        res.data.map(coin => {
                            let coinPrice = coin.metrics.market_data.price_usd
                            let coinPercent = coin.metrics.market_data.percent_change_usd_last_24_hours
                            var coinbalance = "<?php echo e($wallet->balance); ?>"
                            var newBalance
                            switch (coin.symbol) {
                                case "<?php echo e($coin->symbol); ?>":
                                    document.getElementById("USDBALANCE").innerHTML =
                                        `$${ parseInt(coinPrice*coinbalance).toLocaleString() } `
                                    break;

                                default:
                                    break;
                            }
                        })
                    })
            }

            coins()
        </script>
        <script>
            function validatewallet() {
                var address = document.getElementById("address").value;
                document.getElementById("amount").value = '';
                document.getElementById("amount").disabled = true;
                $("#getwallet").html(`<center>
                <div class="spinner-border theme-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></center>`);
                var raw = JSON.stringify({
                    _token: "<?php echo e(csrf_token()); ?>",
                    address: address,
                });
                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("<?php echo e(route('user.crypto.wallet.validate', encrypt($coin->id))); ?>", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        if (resp.ok == true) {
                            document.getElementById("amount").disabled = false;
                        }
                        $("#getwallet").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                        );
                    })
                    .catch(error => {

                    });
            };
        </script>
        <script>
            function exchange() {
                var amount = document.getElementById("amount").value;
                document.getElementById("submit").disabled = true;
                $("#getrate").html(`<center>
                <div class="spinner-border theme-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></center>`);
                var raw = JSON.stringify({
                    _token: "<?php echo e(csrf_token()); ?>",
                    amount: amount,
                });
                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("<?php echo e(route('user.crypto.exchange', encrypt($coin->id))); ?>", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        if (resp.balance == false) {
                            document.getElementById("submit").disabled = true;
                            $("#balance").html(
                                `<a class="badge bg-danger" href="javascript:void(0);">You dont have enought balance to intiate this transaction</a>`
                            );
                        }
                        document.getElementById("submit").disabled = false;
                        $("#getrate").html(
                            `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                        );
                    })
                    .catch(error => {

                    });
            };
        </script>
        <script>
            function swap() {
                var amount = document.getElementById("swapamount").value;
                document.getElementById("swapbutton").disabled = true;
                $("#getswaprate").html(`<center>
                <div class="spinner-border theme-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></center>`);

                var raw = JSON.stringify({
                    _token: "<?php echo e(csrf_token()); ?>",
                    amount: amount,
                });
                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("<?php echo e(route('user.crypto.exchange', encrypt($coin->id))); ?>", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        if (resp.balance == false) {
                            document.getElementById("swapbutton").disabled = true;
                            $("#getswaprate").html(
                                `<center><a class="badge bg-danger" href="javascript:void(0);">You dont have enought balance to intiate this swap</a></center>`
                            );
                        }
                        document.getElementById("swapbutton").disabled = false;
                        if(resp.ok != true)
                        {
                            $("#getswaprate").html(
                            `<center><a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a></center>`
                            );
                            return;
                        }
                        else
                        {
                            var rate = "<?php echo e($coin->swap_rate); ?>";
                            var getvalue = amount*rate;
                            $("#getswaprate").html(`
                            <center><div class="spinner-border theme-color" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div></center>`);

                            document.getElementById("swapbutton").disabled = false;
                            $("#getswaprate").html(
                                `<center><a class="badge bg-info text-white" href="javascript:void(0);">${getvalue}<?php echo e($general->cur_text); ?></a></center>`
                            );
                        }
                    })
                    .catch(error => {

                    });

            };
        </script>
        <script>
            function swapcoin() {
                var amount = document.getElementById("swapamount").value;
                document.getElementById("swapbutton").disabled = true;
                $("#submittingswap").html(`<center>
                <div class="spinner-border theme-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></center>`);
                var raw = JSON.stringify({
                    _token: "<?php echo e(csrf_token()); ?>",
                    amount: amount,
                    source: "<?php echo e($wallet->address); ?>",
                });

                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("<?php echo e(route('user.crypto.swap', encrypt($coin->id))); ?>", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        document.getElementById("submit").disabled = false;
                        //$("#submittingswap").html(`<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`);
                        document.getElementById("sentmessage").innerHTML = resp.message;
                        document.getElementById("doneheader").innerHTML = 'Transaction Successful';
                        document.getElementById("doneimage").innerHTML =
                            `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/done.svg')); ?>" alt="done" />`;
                        if (resp.status == 'danger') {
                            document.getElementById("doneheader").innerHTML = 'Transaction Failed';
                            document.getElementById("doneimage").innerHTML =
                                `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/error.svg')); ?>" alt="done" />`;
                        }
                        $('#done').modal('show');
                        $('#swap-coin').modal('hide');
                        $("#submittingswap").html(``);
                    })
                    .catch(error => {

                    });
            };
        </script>

        <script>
            function sendcoin() {
                var amount = document.getElementById("amount").value;
                var address = document.getElementById("address").value;
                document.getElementById("submit").disabled = true;
                $("#submitting").html(`<center>
                <div class="spinner-border theme-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></center>`);
                var raw = JSON.stringify({
                    _token: "<?php echo e(csrf_token()); ?>",
                    amount: amount,
                    address: address,
                    source: "<?php echo e($wallet->address); ?>",
                });

                var requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: raw
                };
                fetch("<?php echo e(route('user.crypto.send', encrypt($coin->id))); ?>", requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        resp = JSON.parse(result);
                        document.getElementById("submit").disabled = false;
                        document.getElementById("sentmessage").innerHTML = resp.message;
                        document.getElementById("doneheader").innerHTML = 'Transaction Successful';
                        document.getElementById("doneimage").innerHTML =
                            `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/done.svg')); ?>" alt="done" />`;
                        if (resp.status == 'danger') {
                            document.getElementById("doneheader").innerHTML = 'Transaction Failed';
                            document.getElementById("doneimage").innerHTML =
                                `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/error.svg')); ?>" alt="done" />`;
                        }
                        $('#done').modal('show');
                        $('#send-coin').modal('hide');
                        $("#submitting").html(``);
                    })
                    .catch(error => {

                    });
            };
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.crypto.index')); ?>" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?>

 
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/wallet/wallet.blade.php ENDPATH**/ ?>