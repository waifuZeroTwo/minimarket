<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php $preferencesSaved = session('preferences_saved', false); @endphp
        @foreach($products as $product)
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden flex flex-col">
                <a href="{{ route('products.show', [$product['category'], $product['slug']]) }}" wire:navigate>
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-48 w-full object-cover">
                </a>
                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        <a href="{{ route('products.show', [$product['category'], $product['slug']]) }}" wire:navigate>{{ $product['name'] }}</a>
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-300">${{ number_format($product['price'],2) }}</p>
                    <div class="mt-auto space-x-2">
                        <button onclick="Livewire.dispatch('addToCart', {id: {{ $product['id'] }}, name: '{{ $product['name'] }}', price: {{ $product['price'] }}})" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Add to Cart</button>
                        @if($preferencesSaved)
                            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Buy Now</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($this->hasMore)
        <div class="mt-6 text-center">
            <button wire:click="loadMore" class="px-4 py-2 bg-blue-600 text-white rounded">Load More</button>
        </div>
    @endif
</div>
