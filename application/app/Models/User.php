<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_number',
        'bill_account_id',
        'savings_account_id',
        'credit_account_id',
        'general_account_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function creditAccount(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'credit_account_id');
    }

    public function generalAccount(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'general_account_id');
    }

    public function savingsAccount(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'savings_account_id');
    }

    public function billAccount(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'bill_account_id');
    }
}
