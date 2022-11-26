<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Variation extends Model
{
    use HasRecursiveRelationships;

    protected $casts = [
        'price' => PriceCast::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function inStock(): bool
    {
        return $this->stockCount() > 0;
    }

    public function outOfStock(): bool
    {
        return !$this->inStock();
    }

    public function lowStock(): bool
    {
        return $this->inStock() && $this->stockCount() <= 5;
    }

    public function stockCount()
    {
        return $this->descendantsAndSelf->sum(fn ($variation) => $variation->stocks->sum('amount'));
    }
}
