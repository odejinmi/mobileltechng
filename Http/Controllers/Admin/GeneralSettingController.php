<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Image;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'General Setting';
        $timezones = json_decode(file_get_contents(resource_path('mobileapp/admin/partials/timezone.json')));
        return view('admin.setting.general', compact('pageTitle', 'timezones'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'       => 'required|string|max:40',
            'cur_text'        => 'required|string|max:40',
            'cur_sym'         => 'required|string|max:40',
            'base_color'      => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'secondary_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'timezone'        => 'required',
        ]);

        $general                  = gs();
        $general->site_name       = $request->site_name;
        $general->cur_text        = $request->cur_text;
        $general->cur_sym         = $request->cur_sym;
        $general->base_color      = $request->base_color;
        $general->secondary_color = $request->secondary_color;
        
        $general->social_facebook = $request->social_facebook;
        $general->social_twitter = $request->social_twitter;
        $general->social_instagram = $request->social_instagram;
        $general->social_mail = $request->social_mail;
        $general->social_phone = $request->social_phone;
        $general->social_whatsapp = $request->social_whatsapp;
        $general->social_telegram = $request->social_telegram;
        $general->social_youtube = $request->social_youtube;
        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content      = '<?php $timezone = ' . $request->timezone . ' ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'General setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function systemConfiguration()
    {
        $pageTitle = 'System Configuration';
        $general                  = GeneralSetting::first();
        return view('admin.setting.configuration', compact('pageTitle','general'));
    }

    public function systemConfigurationSubmit(Request $request)
    {
        $general                  = GeneralSetting::first();
        $general->welcome_bonus              = $request->welcome_bonus ? Status::ENABLE : Status::DISABLE;
        $general->welcome_bonus_amount              = $request->welcome_bonus_amount;
        $general->login_bonus              = $request->login_bonus ? Status::ENABLE : Status::DISABLE;
        $general->login_earn              = $request->login_earn;
        $general->utilityglobal              = $request->utilityglobal ? Status::ENABLE : Status::DISABLE;
        $general->utilitylocal              = $request->utilitylocal ? Status::ENABLE : Status::DISABLE;
        $general->insurance              = $request->insurance ? Status::ENABLE : Status::DISABLE;
        $general->airtime              = $request->airtime ? Status::ENABLE : Status::DISABLE;
        $general->airtime2cash              = $request->airtime2cash ? Status::ENABLE : Status::DISABLE;
        $general->airtimelocal              = $request->airtimelocal ? Status::ENABLE : Status::DISABLE;
        $general->internet              = $request->internet ? Status::ENABLE : Status::DISABLE;
        $general->internetsme          = $request->internetsme ? Status::ENABLE : Status::DISABLE;
        $general->internetsme_provider = $request->internetsme_provider;
        $general->internet_api_sme_provider = $request->internet_api_sme_provider;
        $general->airtime_provider = $request->airtime_provider;
        $general->cabletv_provider = $request->cabletv_provider;
        $general->request_account              = $request->request_account ? Status::ENABLE : Status::DISABLE;
        $general->loan              = $request->loan ? Status::ENABLE : Status::DISABLE;
        $general->cabletv              = $request->cabletv ? Status::ENABLE : Status::DISABLE;
        $general->crypto               = $request->crypto ? Status::ENABLE : Status::DISABLE;
        $general->crypto_auto               = $request->crypto_auto ? Status::ENABLE : Status::DISABLE;
        $general->giftcard_auto               = $request->giftcard_auto ? Status::ENABLE : Status::DISABLE;

        $general->buy_crypto              = $request->buy_crypto ? Status::ENABLE : Status::DISABLE;
        $general->sell_crypto              = $request->sell_crypto ? Status::ENABLE : Status::DISABLE;
        $general->swap_crypto              = $request->swap_crypto ? Status::ENABLE : Status::DISABLE;
        $general->buy_giftcard              = $request->buy_giftcard ? Status::ENABLE : Status::DISABLE;
        $general->sell_giftcard              = $request->sell_giftcard ? Status::ENABLE : Status::DISABLE;
        $general->event              = $request->event ? Status::ENABLE : Status::DISABLE;
        $general->escrow              = $request->escrow ? Status::ENABLE : Status::DISABLE;

        
        $general->savings               = $request->savings ? Status::ENABLE : Status::DISABLE;
        $general->voucher               = $request->voucher ? Status::ENABLE : Status::DISABLE;
        $general->invoice               = $request->invoice ? Status::ENABLE : Status::DISABLE;
        $general->store_front               = $request->store_front ? Status::ENABLE : Status::DISABLE;
        $general->store_front_fee               = $request->store_front_fee;
        $general->qr                    = $request->qr ? Status::ENABLE : Status::DISABLE;
        $general->virtualcard              = $request->virtualcard ? Status::ENABLE : Status::DISABLE;
        $general->virtualcard_fee_type              = $request->virtualcard_fee_type;
        $general->nuban_provider             = $request->nuban_provider;
        $general->transfer_provider             = $request->transfer_provider;
        $general->virtualcard_fee_flat             = $request->virtualcard_fee_flat;
        $general->virtualcard_fee_percent             = $request->virtualcard_fee_percent;
        $general->virtualcard_request_fee             = $request->virtualcard_request_fee;
        $general->virtualcard_usd_rate                = $request->virtualcard_usd_rate;
        $general->p2p              = $request->p2p ? Status::ENABLE : Status::DISABLE;
        $general->ev              = $request->ev ? Status::ENABLE : Status::DISABLE;
        $general->en              = $request->en ? Status::ENABLE : Status::DISABLE;
        $general->sv              = $request->sv ? Status::ENABLE : Status::DISABLE;
        $general->sn              = $request->sn ? Status::ENABLE : Status::DISABLE;
        $general->ln              = $request->ln ? Status::ENABLE : Status::DISABLE;
        $general->force_ssl       = $request->force_ssl ? Status::ENABLE : Status::DISABLE;
        $general->secure_password = $request->secure_password ? Status::ENABLE : Status::DISABLE;
        $general->registration    = $request->registration ? Status::ENABLE : Status::DISABLE;
        $general->agree           = $request->agree ? Status::ENABLE : Status::DISABLE;

        $general->save();
        $notify[] = ['success', 'System configuration updated successfully'];
        return back()->withNotify($notify);
    }

    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo'    => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'favicon' => ['image', new FileTypeValidate(['png'])],
        ]);

        if ($request->hasFile('logo')) {
            try {
                $path = getFilePath('logoIcon');

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = getFilePath('logoIcon');

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }

    public function customCss()
    {
        $pageTitle    = 'Custom CSS';
        $file         = activeTemplate(true) . 'css/custom.css';
        $file_content = @file_get_contents($file);
        return view('admin.setting.custom_css', compact('pageTitle', 'file_content'));
    }

    public function customCssSubmit(Request $request)
    {
        $file = activeTemplate(true) . 'css/custom.css';

        if (!file_exists($file)) {
            fopen($file, "w");
        }

        file_put_contents($file, $request->css);
        $notify[] = ['success', 'CSS updated successfully'];
        return back()->withNotify($notify);
    }

    public function maintenanceMode()
    {
        $pageTitle   = 'Maintenance Mode';
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        return view('admin.setting.maintenance', compact('pageTitle', 'maintenance'));
    }

    public function maintenanceModeSubmit(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $general                   = GeneralSetting::first();
        $general->maintenance_mode = $request->status ? Status::ENABLE : Status::DISABLE;
        $general->save();

        $maintenance              = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        $maintenance->data_values = [
            'description' => $request->description,
        ];
        $maintenance->save();

        $notify[] = ['success', 'Maintenance mode updated successfully'];
        return back()->withNotify($notify);
    }

    public function cookie()
    {
        $pageTitle = 'GDPR Cookie';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        return view('admin.setting.cookie', compact('pageTitle', 'cookie'));
    }

    public function cookieSubmit(Request $request)
    {
        $request->validate([
            'short_desc'  => 'required|string|max:255',
            'description' => 'required',
        ]);
        $cookie              = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        $cookie->data_values = [
            'short_desc'  => $request->short_desc,
            'description' => $request->description,
            'status'      => $request->status ? Status::ENABLE : Status::DISABLE,
        ];
        $cookie->save();
        $notify[] = ['success', 'Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }
}
