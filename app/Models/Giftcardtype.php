<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Giftcardtype extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "giftcardtypes";



    public function Giftcard()
    {
        return $this->hasMany('App\Models\Giftcard','id');
    }
}
