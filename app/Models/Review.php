<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * @var string[]
     */
    protected $table = 'reviews';
 

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
}
