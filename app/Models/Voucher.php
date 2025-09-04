<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use Searchable;

    protected $casts = [
        'detail' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     
    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }

    
 
}
