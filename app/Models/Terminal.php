<?php

namespace App\Models;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Terminal extends Authenticatable
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    use GlobalStatus, Searchable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function statusBadge(): Attribute {
        return new Attribute(function(){
            $badge = '';
            if($this->user_id){
                $badge = '<span class="badge bg-success">Assigned</span>';
            }else{
                $badge = '<span class="badge bg-danger">Unassigned</span>';
            }
            return $badge;
        });
    }

}
