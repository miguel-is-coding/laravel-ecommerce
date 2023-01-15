<?php

namespace App\Cart;

use App\Cart\Contracts\CartInterface;
use App\Models\Cart as CartModel;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Session\SessionManager;

class Cart implements CartInterface
{
    protected CartModel $instance;

    public function __construct(protected SessionManager $sessionManager)
    {
    }

    public function create(?User $user = null): void
    {
        $instance = CartModel::make();

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

    public function add(Variation $variation, int $quantity = 1): void
    {
        if ($existingVariation = $this->getVariations($variation)) {
            $quantity += $existingVariation->pivot->quantity;
        }
        $this->instance()->variations()->syncWithoutDetaching([
            $variation->id => [
                'quantity' => min($quantity, $variation->stockCount())
            ]
        ]);
    }

    protected function instance(): CartModel
    {
        return $this->instance ??
            ($this->instance = CartModel::whereUuid($this->sessionManager->get(config('cart.session.key')))->first());
    }

    public function getVariations(Variation $variation)
    {
        return $this->instance()->variations()->find($variation->id);
    }
}
