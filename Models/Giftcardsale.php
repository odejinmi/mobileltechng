<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Giftcardsale extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "giftcardsales";

  public function giftcard()
    {
        return $this->belongsTo('App\Models\Giftcard','id');
    }
     public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function trx()
    {
        return $this->hasMany('App\Models\Transaction','id');
    }
}
