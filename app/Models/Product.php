<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Searchable;

    protected $casts = [
        'name' => 'object'
    ];

    public function store()
    {
        return $this->belongsTo(Storefront::class);
    }
     
    
 
}
