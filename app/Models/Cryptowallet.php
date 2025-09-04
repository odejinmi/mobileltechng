<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cryptowallet extends Model
{
	use HasFactory;
	public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function coin()
    {
        return $this->belongsTo(Cryptocurrency::class, 'coin_id');
    } 
}
