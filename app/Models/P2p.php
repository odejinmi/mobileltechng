<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class P2p extends Model
{
    use Searchable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'receiver');
    } 

}
