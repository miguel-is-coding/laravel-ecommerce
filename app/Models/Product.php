<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'price' => PriceCast::class,
    ];
}
