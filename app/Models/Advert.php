<?php

namespace App\Models;

use App\Models\User;
use App\Models\AdvertCatgeory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    /**
     * @var string[]
     */
    protected $table = 'adverts';

    public function category(){
    	return $this->belongsTo(AdvertCatgeory::class);
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
