<?php

namespace App\Casts;

use App\ValueObjects\Price as PriceValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PriceCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return new PriceValueObject($value ?? 0);
    }

    public function set($model, $key, $value, $attributes)
    {
        return $value instanceof PriceValueObject ? $value->original() : ($value ?? 0);
    }
}
