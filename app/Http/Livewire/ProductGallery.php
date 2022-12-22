<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class ProductGallery extends Component
{
    public Product $product;

    public string $selectedImageUrl;

    public function mount(): void
    {
        $this->selectedImageUrl = $this->product->getFirstMediaUrl();
    }

    public function selectImage(string $url): void
    {
        $this->selectedImageUrl = $url;
    }

    public function render(): View
    {
        return view('livewire.product-gallery');
    }
}
