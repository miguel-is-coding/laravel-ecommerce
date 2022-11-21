<div>
    @if($initialVariation)
        <livewire:product-dropdown :variations="$initialVariation"/>
    @endif

    @if($skuVariant)
        <div class="space-y-6">
            <div class="font-semibold text-lg">
                {{ $skuVariant->price->valueFormatted() }}
            </div>
            <x-primary-button wire:click.prevent="addToCart">Add to cart</x-primary-button>
        </div>
    @endif
</div>
