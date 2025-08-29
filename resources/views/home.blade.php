<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <livewire:product-list />
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
