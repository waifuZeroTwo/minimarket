<div class="bg-white dark:bg-gray-800 shadow rounded p-4 text-gray-800 dark:text-gray-100">
    <h3 class="text-lg font-semibold mb-2">Cart Summary</h3>
    <ul class="space-y-1">
        @forelse($cart as $item)
            <li class="flex justify-between text-sm">
                <span>{{ $item['name'] }} x {{ $item['qty'] }}</span>
                <span>${{ number_format($item['price'] * $item['qty'], 2) }}</span>
            </li>
        @empty
            <li class="text-sm text-gray-500">Your cart is empty.</li>
        @endforelse
    </ul>
    <div class="mt-4 border-t pt-2 text-sm space-y-1">
        <div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($subtotal,2) }}</span></div>
        <div class="flex justify-between"><span>Shipping Estimate</span><span>${{ number_format($shipping,2) }}</span></div>
        @if($coupon)
            <div class="flex justify-between text-green-600"><span>Coupon ({{ $coupon['code'] }})</span><span>- ${{ number_format($this->couponSavings,2) }}</span></div>
        @endif
        <div class="flex justify-between font-semibold"><span>Total</span><span>${{ number_format($this->total,2) }}</span></div>
        <div class="mt-2 text-xs text-gray-500">Loyalty points: {{ $loyaltyPoints }}</div>
    </div>
    <div class="mt-3 flex">
        <input type="text" wire:model.defer="couponCode" placeholder="Coupon code" class="flex-1 rounded-l border-gray-300" />
        <button wire:click="applyCoupon($couponCode)" class="px-3 py-2 bg-blue-600 text-white rounded-r">Apply</button>
    </div>
    @if($this->upsellItems)
        <div class="mt-4 border-t pt-2">
            <h4 class="text-sm font-semibold mb-2">You might also like</h4>
            <ul class="space-y-1 text-sm">
                @foreach($this->upsellItems as $item)
                    <li class="flex justify-between">
                        <span>{{ $item['name'] }}</span>
                        <button onclick="Livewire.dispatch('addToCart', {id: {{ $item['id'] }}, name: '{{ $item['name'] }}', price: {{ $item['price'] }} })" class="text-blue-600">Add ${{ number_format($item['price'],2) }}</button>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-return-policy />

    <div class="mt-4 flex space-x-2">
        <a href="{{ route('checkout') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Checkout</a>
        @auth
            <a href="{{ route('checkout', ['oneclick' => 1]) }}" class="px-4 py-2 bg-green-600 text-white rounded">One-Click Checkout</a>
        @endauth
    </div>
</div>
