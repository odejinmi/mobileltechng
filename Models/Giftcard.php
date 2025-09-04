<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Giftcard extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "giftcards";



    public function trx()
    {
        return $this->hasMany('App\Models\Transaction','id');
    }
}
