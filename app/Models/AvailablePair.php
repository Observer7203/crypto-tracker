<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailablePair extends Model
{
    protected $fillable = [
        'symbol',
        'base_asset',
        'quote_asset',
    ];
}
