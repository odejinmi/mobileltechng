<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class RequestPaymentAccount extends Model
{
	use GlobalStatus, Searchable;

	public function requests()
	{
		return $this->hasMany(RequestPayment::class);
	}
}