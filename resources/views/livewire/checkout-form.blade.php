<div class="bg-white dark:bg-gray-800 shadow rounded p-4 text-gray-800 dark:text-gray-100">
    @if($errorMessage)
        <div class="mb-4 text-red-600">{{ $errorMessage }}</div>
    @endif

    <div class="space-y-2">
        <div>
            <label class="block text-sm">Address</label>
            <input type="text" wire:model="shipping.address" class="w-full border-gray-300 rounded" />
        </div>
        <div class="flex space-x-2">
            <div class="flex-1">
                <label class="block text-sm">City</label>
                <input type="text" wire:model="shipping.city" class="w-full border-gray-300 rounded" />
            </div>
            <div class="flex-1">
                <label class="block text-sm">Postal Code</label>
                <input type="text" wire:model="shipping.postal_code" class="w-full border-gray-300 rounded" />
            </div>
        </div>
        <div>
            <label class="block text-sm">Card Last Four</label>
            <input type="text" wire:model="payment.card_last_four" class="w-full border-gray-300 rounded" />
        </div>
        <div>
            <label class="block text-sm">Payment Token</label>
            <input type="text" wire:model="payment.token" class="w-full border-gray-300 rounded" />
        </div>
    </div>

    <div class="mt-4 flex space-x-2">
        <button type="button" wire:click="fillFromPreferences" class="px-4 py-2 bg-green-600 text-white rounded">One-Click Checkout</button>
        <button type="button" wire:click="savePreferences" class="px-4 py-2 bg-blue-600 text-white rounded">Save Preferences</button>
    </div>
</div>
