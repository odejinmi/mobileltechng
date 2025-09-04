<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded  = ['id'];
    protected $casts    = ['attributes'=>'array'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    
    public static function insertUserToCart($user_id, $session_id)
    {
        $cart = self::where('session_id', $session_id)->get();

        self::where('session_id', $session_id)->update(['user_id'=>$user_id]);
    }
}
