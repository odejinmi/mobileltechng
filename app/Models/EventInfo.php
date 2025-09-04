<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventInfo extends Model
{
    use HasFactory;

    protected $dates = ['available_time'];

    public function propertyOptionalImage()
    {
        return $this->hasMany(PropertyOptionalImage::class);
    }

    public function propertyAmenities()
    {
        return $this->hasMany(PropertyAmenities::class);
    }
}
