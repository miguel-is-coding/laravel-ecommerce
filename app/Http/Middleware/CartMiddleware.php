<?php

namespace App\Http\Middleware;

use App\Cart\Contracts\CartInterface;
use Closure;
use Illuminate\Http\Request;

class CartMiddleware
{
    public function __construct(protected CartInterface $cart)
    {

    }
    public function handle(Request $request, Closure $next)
    {
        if ($this->cartDoesNotExists()) {
            $this->cart->create($request->user());
        }
        return $next($request);
    }

    /**
     * @return bool
     */
    public function cartDoesNotExists(): bool
    {
        return !$this->cart->exists();
    }
}
