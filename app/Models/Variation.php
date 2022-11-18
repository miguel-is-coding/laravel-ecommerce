<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Variation extends Model
{
    use HasRecursiveRelationships;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
