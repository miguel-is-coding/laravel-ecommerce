<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) \Str::uuid();
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
