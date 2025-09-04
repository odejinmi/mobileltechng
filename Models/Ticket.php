<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    use Searchable;


    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'trx_id');
    }

}
