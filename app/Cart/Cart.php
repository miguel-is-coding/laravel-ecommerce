<?php

namespace App\Cart;

use App\Cart\Contracts\CartInterface;
use App\Models\User;
use Illuminate\Session\SessionManager;

class Cart implements CartInterface
{
    public function __construct(protected SessionManager $sessionManager)
    {
    }

    public function create(?User $user = null)
    {
        $instance = \App\Models\Cart::make();

        if ($user)
        {
            $instance->user()->associate($user);
        }

        $instance->save();
        $this->sessionManager->put(config('cart.session.key'), $instance->uuid);
    }

    public function exists()
    {
        return $this->sessionManager->has(config('cart.session.key'));
    }
}
