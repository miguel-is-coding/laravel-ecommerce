<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductShowController extends Controller
{
    public function __invoke(Product $product): View
    {
        $product->load('variations.children', 'variations.descendantsAndSelf.stocks');
        return view('products.show', [
            'product' => $product
        ]);
    }
}
