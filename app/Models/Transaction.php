<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Searchable;
    protected $casts = [ 
        'val_1' => 'object'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'val_1');
    }

}
