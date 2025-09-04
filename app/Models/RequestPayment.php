<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class RequestPayment extends Model
{
	use GlobalStatus, Searchable;

	public function account()
	{
		return $this->belongsTo(RequestPaymentAccount::class, 'account_id');
	}
	public function user()
    {
        return $this->belongsTo(User::class);
    }
}