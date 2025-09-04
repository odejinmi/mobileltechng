<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="">
                            <div class="form-group mb-3">
                                    <label> <?php echo app('translator')->get('Site Title'); ?></label>
                                    <input class="form-control" type="text" name="site_name" required
                                        value="<?php echo e($general->site_name); ?>">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Currency'); ?></label>
                                    <input class="form-control" type="text" name="cur_text" required
                                        value="<?php echo e($general->cur_text); ?>">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Currency Symbol'); ?></label>
                                    <input class="form-control" type="text" name="cur_sym" required
                                        value="<?php echo e($general->cur_sym); ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label> <?php echo app('translator')->get('Timezone'); ?></label>
                                <select class="form-control select2-basic" name="timezone">
                                    <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="'<?php echo e(@$timezone); ?>'"><?php echo e(__($timezone)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Facebook Link'); ?></label>
                                    <input class="form-control" type="text" name="social_facebook" 
                                        value="<?php echo e($general->social_facebook); ?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Twitter Link'); ?></label>
                                    <input class="form-control" type="text" name="social_twitter" 
                                        value="<?php echo e($general->social_twitter); ?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Instagram Link'); ?></label>
                                    <input class="form-control" type="text" name="social_instagram" 
                                        value="<?php echo e($general->social_instagram); ?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Contact Email'); ?></label>
                                    <input class="form-control" type="text" name="social_mail" 
                                        value="<?php echo e($general->social_mail); ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Contact Phone'); ?></label>
                                    <input class="form-control" type="text" name="social_phone" 
                                        value="<?php echo e($general->social_phone); ?>">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Whatsapp Link'); ?></label>
                                    <input class="form-control" type="text" name="social_whatsapp" 
                                        value="<?php echo e($general->social_whatsapp); ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Telegram Link'); ?></label>
                                    <input class="form-control" type="text" name="social_telegram" 
                                        value="<?php echo e($general->social_telegram); ?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Youtube Link'); ?></label>
                                    <input class="form-control" type="text" name="social_youtube" 
                                        value="<?php echo e($general->social_youtube); ?>">
                                </div>
                            </div>
                             
                                       <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                          <label class="font-weight-medium mb-1" for="position-bottom-left"><?php echo app('translator')->get('Site Base Color'); ?></label>
                                          <input type="text" id="position-bottom-left"  name="base_color" class="form-control demo" data-position="bottom left"
                                            value="<?php echo e($general->base_color); ?>" />
                                        </div> 
                                       </div>
                                      <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                          <label class="font-weight-medium mb-1" for="position-bottom-right"><?php echo app('translator')->get('Site Secondary Color'); ?></label>
                                          <input type="text" id="position-bottom-right" name="secondary_color" class="form-control demo"
                                            data-position="bottom right" value="<?php echo e($general->secondary_color); ?>" />
                                        </div>
                                        
                                       


                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-lib'); ?>

    <script src="<?php echo e(asset('assets/thirdparty/js/spectrum.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/%40claviska/jquery-minicolors/jquery.minicolors.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/thirdparty/css/spectrum.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<script src="<?php echo e(asset('assets/assets/dist/libs/jquery-asColor/dist/jquery-asColor.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/dist/libs/jquery-asGradient/dist/jquery-asGradient.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/dist/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/dist/libs/%40claviska/jquery-minicolors/jquery.minicolors.min.js')); ?>"></script>
<script>
    $(".demo").each(function () {
      //
      // Dear reader, it's actually very easy to initialize MiniColors. For example:
      //
      //  $(selector).minicolors();
      //
      // The way I've done it below is just for the demo, so don't get confused
      // by it. Also, data- attributes aren't supported at this time...they're
      // only used for this demo.
      //
      $(this).minicolors({
        control: $(this).attr("data-control") || "hue",
        defaultValue: $(this).attr("data-defaultValue") || "",
        format: $(this).attr("data-format") || "hex",
        keywords: $(this).attr("data-keywords") || "",
        inline: $(this).attr("data-inline") === "true",
        letterCase: $(this).attr("data-letterCase") || "lowercase",
        opacity: $(this).attr("data-opacity"),
        position: $(this).attr("data-position") || "bottom left",
        swatches: $(this).attr("data-swatches")
          ? $(this).attr("data-swatches").split("|")
          : [],
        change: function (value, opacity) {
          if (!value) return;
          if (opacity) value += ", " + opacity;
          if (typeof console === "object") {
            console.log(value);
          }
        },
        theme: "bootstrap",
      });
    });
  </script>

   <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'<?php echo e(config('app.timezone')); ?>'").select2();
            $('.select2-basic').select2({
                dropdownParent: $('.card-body')
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/setting/general.blade.php ENDPATH**/ ?>