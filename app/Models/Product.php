<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $casts = [
        'price' => PriceCast::class,
    ];

    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class);
    }
}
