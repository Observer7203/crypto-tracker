<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryptoRate extends Model
{
    protected $fillable = ['crypto_pair_id', 'rate', 'timestamp'];

    public function pair(): BelongsTo
    {
        return $this->belongsTo(CryptoPair::class, 'crypto_pair_id');
    }

    public $timestamps = false;
}
