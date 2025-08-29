<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-4">Order History</h2>
            @php
                $orders = [
                    ['id' => 1001, 'date' => '2024-01-01', 'total' => 120.00],
                    ['id' => 1002, 'date' => '2024-02-15', 'total' => 75.50],
                ];
            @endphp
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="border p-4 rounded">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold">Order #{{ $order['id'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">{{ $order['date'] }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold">${{ number_format($order['total'],2) }}</div>
                                <a href="{{ route('orders.return', $order['id']) }}" class="mt-2 inline-block px-3 py-1 bg-indigo-600 text-white rounded text-sm">Return Items</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-return-policy />
        </div>
    </div>
</x-app-layout>
