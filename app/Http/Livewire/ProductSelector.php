<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Variation;
use Livewire\Component;

class ProductSelector extends Component
{
    public Product $product;
    public $initialVariation;
    public $skuVariant;

    protected $listeners = [
        'skuVariantSelected'
    ];

    public function mount()
    {
        $this->initialVariation = $this->product->variations->sortBy('order')->groupBy('type')->first();
    }

    public function skuVariantSelected($variationID)
    {
        if(is_null($variationID)) {
            $this->skuVariant = null;
        } else {
            $this->skuVariant = Variation::find($variationID);
        }
    }

    public function addToCart()
    {
        dd($this->skuVariant);
    }

    public function render()
    {
        return view('livewire.product-selector');
    }
}
