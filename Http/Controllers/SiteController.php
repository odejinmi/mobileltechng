<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Language; 
use App\Models\Page;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\Subscriber;
use App\Models\Transaction;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Cryptocurrency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

use DB;
class SiteController extends Controller
{
    
    public function index()
    { 
        $pageTitle = 'Home';
        return to_route('user.login');

        return view($this->activeTemplate . 'home', compact('pageTitle'));
    }

    public function rates()
	{
		$pageTitle = 'Currency Assets Rates';
		$coins = Cryptocurrency::whereStatus(1)->get();
        return view($this->activeTemplate . 'rates', compact('pageTitle', 'coins'));
	}
 
    public function placeholderImage($size = null)
    {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile  = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);

        if ($fontSize <= 9) {
            $fontSize = 9;
        }

        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }
    
    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general   = gs();

        if ($general->maintenance_mode == Status::DISABLE) {
            return to_route('home');
        }

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view($this->activeTemplate . 'maintenance', compact('pageTitle', 'maintenance'));
    }
}
