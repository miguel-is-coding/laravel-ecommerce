<?php

namespace App\Http\Controllers;

use App\Cart\Contracts\CartInterface;
use App\Models\Category;

class HomeController extends Controller
{
    public function __invoke(CartInterface $cart)
    {
        $cart->create();
        $categories = Category::tree()->get()->toTree();

        return view('home', [
            'categories' => $categories,
        ]);
    }
}
