<?php

namespace App\Models;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TerminalFee extends Authenticatable
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    use GlobalStatus, Searchable;
 
    
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
