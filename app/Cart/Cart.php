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

        if ($user) {
            $instance->user()->associate($user);
        }

        $instance->save();
        $this->sessionManager->put(config('cart.session.key'), $instance->uuid);
    }

    public function exists()
    {
        return $this->sessionManager->has(config('cart.session.key'));
    }

    public function contents()
    {
        return $this->instance()->variations;
    }

    public function contentsCount(): int
    {
        return $this->contents()->count();
    }

    protected function instance()
    {
        return \App\Models\Cart::whereUuid($this->sessionManager->get(config('cart.session.key')))->first();
    }
}
