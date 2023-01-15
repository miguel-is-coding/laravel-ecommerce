<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Cart\Contracts\CartInterface;
use Illuminate\View\View;
use Livewire\Component;

class Navigation extends Component
{
    protected $listeners = [
        'cart.updated' => '$refresh',
    ];

    public function getCartProperty(CartInterface $cart): Cart
    {
        return $cart;
    }
    public function render(): View
    {
        return view('livewire.navigation');
    }
}
