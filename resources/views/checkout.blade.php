<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-4">Checkout</h2>
            <p class="mb-6">Complete your purchase below.</p>

            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-2">Order Summary</h3>
                <p>Your cart items will appear here.</p>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-2">Returns &amp; Exchanges</h3>
                <p class="mb-2">Need to return something later? You can request a return or exchange from your <a href="{{ route('orders.index') }}" class="text-indigo-600">order history</a>.</p>
                <x-return-policy />
            </div>
        </div>
    </div>
</x-app-layout>
