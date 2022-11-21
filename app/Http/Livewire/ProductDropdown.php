<?php

namespace App\Http\Livewire;

use App\Models\Variation;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductDropdown extends Component
{
    public Collection $variations;

    public $selectedVariationID;

    public function getSelectedVariationModelProperty()
    {
        if(is_null($this->selectedVariationID)){
            return null;
        }

        return Variation::find($this->selectedVariationID);
    }

    public function render()
    {
        return view('livewire.product-dropdown');
    }

    public function updatedSelectedVariationID()
    {
        $this->emitTo('product-selector', 'skuVariantSelected', null);

        if($this->selectedVariationModel?->sku) {
            $this->emitTo('product-selector', 'skuVariantSelected', $this->selectedVariationID);
        }
    }
}
