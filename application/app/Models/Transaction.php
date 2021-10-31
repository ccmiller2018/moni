<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    public function merchants(): HasOne
    {
        return $this->hasOne(Merchant::class, 'id', 'merchant_id');
    }
}
