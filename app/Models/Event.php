<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'tickets' => 'object'
    ];


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function info()
    {
        return $this->hasOne(EventInfo::class, 'event_id');
    }   
    
    public function type()
    {
        return $this->belongsTo(EventType::class, 'event_type');
    }


}
