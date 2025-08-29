<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-4">Return Order #{{ $order }}</h2>
            <p class="mb-4">Use the shipping label below to return your items.</p>

            <div class="border p-6 mb-4 bg-white dark:bg-gray-800">
                <h3 class="font-semibold mb-2">Shipping Label</h3>
                <p class="text-sm">Order: {{ $order }}</p>
                <p class="text-sm">Ship to: Minimarket Returns Dept., 123 Market St, Commerce City, CO 80022</p>
            </div>

            <button onclick="window.print()" class="px-4 py-2 bg-indigo-600 text-white rounded">Print Shipping Label</button>

            <x-return-policy />
        </div>
    </div>
</x-app-layout>
