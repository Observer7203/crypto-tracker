<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CryptoPair extends Model
{
    protected $fillable = ['base_currency', 'quote_currency', 'is_active', 'update_interval', 'current_price'];

    public function rates(): HasMany
    {
        return $this->hasMany(CryptoRate::class);
    }

    // app/Models/CryptoPair.php
public function latestRate()
{
    return $this->hasOne(CryptoRate::class)->latestOfMany('timestamp');
}
}
