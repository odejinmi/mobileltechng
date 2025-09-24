<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Constants\Status;

class User extends Authenticatable
{
    use HasApiTokens, Searchable;

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'google_id',
        'avatar',
        'status',
        'ev',
        'sv',
        'ts',
        'tv',
        'theme',
        // ... other existing fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'kyc' => 'object',
        'ver_code_send_at' => 'datetime'
    ];


    public function loginLogs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function p2p()
    {
        return $this->hasMany(P2p::class);
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->firstname . ' ' . $this->lastname,
        );
    }

    public function plan(){
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    // SCOPES
    public function scopeActive()
    {
        return $this->where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned()
    {
        return $this->where('status', Status::USER_BAN);
    }

    public function scopeEmailUnverified()
    {
        return $this->where('ev', Status::UNVERIFIED);
    }

    public function scopeMobileUnverified()
    {
        return $this->where('sv', Status::UNVERIFIED);
    }
    public function scopeEmailVerified()
    {
        return $this->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified()
    {
        return $this->where('sv', Status::VERIFIED);
    }

    public function scopeWithBalance()
    {
        return $this->where('balance', '>', 0);
    }
}
