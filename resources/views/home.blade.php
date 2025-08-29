<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $products = [
                        ['id' => 1, 'name' => 'Espresso', 'price' => 3.50, 'image' => 'https://source.unsplash.com/random/300x300?espresso'],
                        ['id' => 2, 'name' => 'Cappuccino', 'price' => 4.25, 'image' => 'https://source.unsplash.com/random/300x300?cappuccino'],
                        ['id' => 3, 'name' => 'Latte', 'price' => 4.75, 'image' => 'https://source.unsplash.com/random/300x300?latte'],
                        ['id' => 4, 'name' => 'Mocha', 'price' => 5.00, 'image' => 'https://source.unsplash.com/random/300x300?mocha'],
                    ];
                    $preferencesSaved = session('preferences_saved', false);
                @endphp
                @foreach($products as $product)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden flex flex-col">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-48 w-full object-cover">
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $product['name'] }}</h3>
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
        </div>
    </div>

    <div class="fixed bottom-6 right-6 w-80">
        <livewire:cart-summary />
    </div>

    <div id="exit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
            <h2 class="text-xl font-semibold">Wait!</h2>
            <p class="mt-2">{{ auth()->user()?->name ? 'Hey '.auth()->user()->name.',' : '' }} take 10% off with code <span class="font-bold">SAVE10</span></p>
            <button id="close-exit-modal" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Continue Shopping</button>
        </div>
    </div>

    <script>
        const exitModal = document.getElementById('exit-modal');
        const closeExitModal = document.getElementById('close-exit-modal');
        let exitShown = false;
        document.addEventListener('mouseleave', e => {
            if (e.clientY <= 0 && !exitShown) {
                exitModal.classList.remove('hidden');
                exitModal.classList.add('flex');
                exitShown = true;
            }
        });
        closeExitModal.addEventListener('click', () => {
            exitModal.classList.add('hidden');
        });
    </script>
</x-app-layout>
