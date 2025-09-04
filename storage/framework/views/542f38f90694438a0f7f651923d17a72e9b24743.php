<?php $__env->startSection('panel'); ?>

    <!-- crypto request starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <?php if(count($type) < 1): ?>
                <div class="alert alert-danger">
                    <strong>Hello Boss!</strong> We currently dont accept <?php echo e($card->name); ?> at the
                    moment. Please
                    check back later or try selling other type of card to us. Thank you for choosing
                    <?php echo e($general->site_name); ?>.
                </div>
            <?php else: ?>
                <div class="element-list">
                    <div class="alert theme-alert w-100" role="alert">

                        <strong>Hello Boss!</strong> Please select the type of <?php echo e($card->name); ?> You
                        want to <?php echo e($tradetype); ?>

                        and specify card type <b>"Physical Card or Digital Card"</b>
                        the confirm button to push your card to us.
                    </div>
                </div>
            <?php endif; ?>
            <div class="currency-transfer">
                <form role="form" class="auth-form crypto-form" method="POST" action="" enctype="multipart/form-data">

                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label for="inputassets" class="form-label mb-2">Request payment</label>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" id="cardtype">Select
                                    Card</a>

                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li
                                            onclick="myFunction('<?php echo e($data->name); ?>','<?php echo e($data->id); ?>','<?php echo e($data->currency); ?>','<?php echo e($data->sell_rate); ?>','<?php echo e($data->buy_rate); ?>','<?php echo e($tradetype); ?>')">
                                            <a class="dropdown-item"><img class="img-fluid currency-icon"
                                                    src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($card->image); ?>"
                                                    alt="<?php echo e($data->name); ?>" /><?php echo e($data->name); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>

                        <input name="typerate" hidden id="typerate">
                        <input name="typeid" hidden id="typeid">
                        <input name="typecurrency" hidden id="typecur">
                        <input name="type" hidden id="cardtypeid">
                        <input name="card" hidden value="<?php echo e($card->id); ?>">
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <h5 class="light-text mb-0">Rate:</h5>
                            <h5 class="theme-color fw-normal mb-0" id="exrate"><?php echo e($general->cur_sym); ?>0.00</h5>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputname" class="form-label">Amount <b id="currency"></b></label>
                        <div class="form-input">
                            <input type="number" <?php if(count($type) < 1): ?> disabled <?php endif; ?> id="usd"
                                onkeyup="myRate(this)" class="form-control" name="amount" placeholder=" 0.00" />
                        </div>
                    </div>

                    <div class="option d-block mt-3">
                        <label for="inputassets" class="form-label mb-2">Card Type</label>
                        <div class="form-check">
                            <input class="form-check-input" onchange="cardType('physical')" value="physical" type="radio"
                                name="typeofcard" id="flexradio1" />
                            <label class="form-check-label" for="flexradio1">Physical</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" onchange="cardType('digital')" value="digital" type="radio"
                                name="typeofcard" id="flexradio2" />
                            <label class="form-check-label" for="flexradio2">Digital</label>
                        </div>
                    </div>

                    <?php if($tradetype == 'sell'): ?>
                        <div id="physical">
                            <div class="form-group">
                                <div class="upload-image rounded-image">
                                    <label for="formFileLg" class="form-label d-none">Front View </label>
                                    <input class="form-control upload-file" type="file" onchange="readURL(this);"
                                        <?php if(count($type) < 1): ?> disabled <?php endif; ?> accept='image/*' type="file"
                                        id="formFileLg">
                                     <img id="khaytech" class="upload-icon dark-text" width="35" src="https://static.vecteezy.com/system/resources/previews/015/337/675/original/transparent-upload-icon-free-png.png" />
                                </div>
                                <h3 class="info-id">Upload front view of card</h3>

                            </div>
                            <div class="form-group">
                                <div class="upload-image rounded-image">
                                    <label for="formFileLg" class="form-label d-none">Back View </label>
                                    <input class="form-control upload-file" onchange="readURL2(this);"
                                        <?php if(count($type) < 1): ?> disabled <?php endif; ?> name='back' accept='image/*'
                                        type="file" id="formFileLg">
                                     <img id="khaytech2" class="upload-icon dark-text" width="35" src="https://static.vecteezy.com/system/resources/previews/015/337/675/original/transparent-upload-icon-free-png.png" />

                                </div>
                                <h3 class="info-id">Upload back view of card.</h3>

                            </div>
                        </div>
                            <?php $__env->startPush('script'); ?>
                            <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                    document.querySelector('#khaytech').setAttribute('src',e.target.result )
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                    }
                                }
                                
                            function readURL2(input) {
                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                    document.querySelector('#khaytech2').setAttribute('src',e.target.result )
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                            <?php $__env->stopPush(); ?>
                        <div class="form-group" id="digital">
                            <label class='form-label' for='buysell-amount'>Enter Gift Card Code</label>
                            <input type='text' <?php if(count($type) < 1): ?> disabled <?php endif; ?>
                                placeholder='QWERTY*******' class='form-control' name='code'>
                        </div>
                    <?php endif; ?>



                    <div class="transfer-btn">
                        <div class="custom-container">
                            <button type="submit" <?php if(count($type) < 1): ?> disabled <?php endif; ?>
                                class="btn theme-btn sub-btn  w-100">Confirm</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <!-- crypto request end -->
    <?php $__env->startPush('script'); ?>
        <script>
            function myFunction(name, typeid, cur, sellrate, buyrate, type) {
                var usd = $('#usd').val();
                var rate = sellrate;
                if (type == 'buy') {
                    var rate = buyrate;
                }
                localStorage.setItem('cur', cur);
                localStorage.setItem('rate', rate);
                document.getElementById("currency").innerHTML = '(' + cur + ')';
                document.getElementById("cardtype").innerHTML = name;
                document.getElementById("exrate").innerHTML = "1" + cur + " = <?php echo e($general->cur_sym); ?>" + rate;
                document.getElementById("typerate").value = rate;
                document.getElementById("typecur").value = cur;
                document.getElementById("typeid").value = typeid;
                document.getElementById("cardtypeid").value = typeid;

            };

            function myRate(e) {
                var usd = e.value;
                var cur = localStorage.getItem('cur');
                var xrate = localStorage.getItem('rate');
                var rate = usd * xrate;
                document.getElementById("exrate").innerHTML = "1" + cur + " = <?php echo e($general->cur_sym); ?>" + rate;
            }
        </script>
        <script>
            $("#digital").hide();
            $("#physical").hide();

            function cardType(value) {
                if (value == 'physical') {
                    $("#digital").hide();
                    $("#physical").show();
                } else {
                    $("#physical").hide();
                    $("#digital").show();
                }
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/giftcard/giftcard-select.blade.php ENDPATH**/ ?>