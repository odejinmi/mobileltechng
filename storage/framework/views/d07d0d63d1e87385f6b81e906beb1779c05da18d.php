<?php $__env->startSection('panel'); ?>

   <!-- banner section starts -->
   <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banner1.png')); ?>" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')); ?>" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->
    

   

  <!-- Buy & Sell history section starts -->
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Assets</h2>
        <a href="#"></a>
      </div>

      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="<?php echo e(route('user.crypto.wallet',encrypt($data->id))); ?>" class="d-flex gap-3">
              <div class="transaction-imagse color1">
                <img class="img-fluids icons" src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e(@$data->image); ?>" width="40" alt="bitcoins" />
                
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e($data->name); ?></h5>
                  <h5 class="error-colors" id="<?php echo e($data->symbol); ?>percent"><li>
                    <div class="spinner-border theme-color" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </li></h5>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"><?php echo e($data->symbol); ?></h5>
                  <h5 class="success-colors" id="<?php echo e($data->symbol); ?>"><li>
                    <div class="spinner-border text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </li></h5>
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
<?php $__env->stopSection(); ?>



<?php $__env->startPush('script'); ?>
<script>
    const priceElement = document.querySelectorAll(".price")
    const percentElement = document.querySelectorAll(".percent")
    
    let btcBalance = document.querySelector("#btc-balance")
    let ethBalance = document.querySelector("#eth-balance")
    let bchBalance = document.querySelector("#bch-balance")
    let ltcBalance = document.querySelector("#ltc-balance")
    let usdcBalance = document.querySelector("#usdc-balance")
    let xrpBalance = document.querySelector("#xrp-balance")
    
    const coins = async () => {
        await fetch('https://data.messari.io/api/v1/assets')
        .then(data => data.json())
        .then(res => {
            res.data.map(coin => {
                let coinPrice = coin.metrics.market_data.price_usd
                let coinPercent = coin.metrics.market_data.percent_change_usd_last_24_hours
                var newBalance
                switch (coin.symbol) {
                    case "BTC":
                        document.getElementById("BTC").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("BTCpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("BTCpercent").style.color = "green"
                        }
                        document.getElementById("BTCpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        break;
                    case "ETH":
                         document.getElementById("ETH").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("ETHpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("ETHpercent").style.color = "green"
                        }
                        document.getElementById("ETHpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "USDT":
                        document.getElementById("USDTERC20").innerHTML = `$${coinPrice.toFixed(0) } `
                        document.getElementById("TCN").innerHTML = `$${coinPrice.toFixed(0) } ` 
     
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("USDTERC20percent").style.color = "red"
                            document.getElementById("TCNpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("USDTERC20percent").style.color = "green"
                            document.getElementById("TCNpercent").style.color = "green"
                        }
                        document.getElementById("USDTERC20percent").innerHTML = `${coinPercent.toFixed(2)}%`
                        document.getElementById("TCNpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "BCH":
                         document.getElementById("BCH").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("BCHpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("BCHpercent").style.color = "green"
                        }
                        document.getElementById("BCHpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "LTC":
                         document.getElementById("LTC").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("LTCpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("LTCpercent").style.color = "green"
                        }
                        document.getElementById("LTCpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                    break;
    
                    case "BNB":
                         document.getElementById("BNB").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("BNBpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("BNBpercent").style.color = "green"
                        }
                        document.getElementById("BNBpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "XRP":
                         document.getElementById("DASH").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("DASHpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("DASHpercent").style.color = "green"
                        }
                        document.getElementById("DASHpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
    
                    case "DOGE":
                         document.getElementById("DOGE").innerHTML = `$${coinPrice.toFixed(0) } ` 
                        //newBalance = Number(btcBalance.innerHTML) / Number(coinPrice)
                         //btcBalance.innerHTML = newBalance.toFixed(4)
                        if(coinPercent < 0){
                            document.getElementById("DOGEpercent").style.color = "red"
                        }
                        else{
                            document.getElementById("DOGEpercent").style.color = "green"
                        }
                        document.getElementById("DOGEpercent").innerHTML = `${coinPercent.toFixed(2)}%`
                        
                    break;
                    
    
                    default:
                        break;
                    
                }
            })
        })

    document.getElementById("LTC").innerHTML = '$'+0; 
    document.getElementById("LTCpercent").innerHTML = 0+'%';
    }
    
    coins()
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/wallet/index.blade.php ENDPATH**/ ?>