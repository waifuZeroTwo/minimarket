<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="list-reset flex">
                    <li><a href="{{ route('home') }}" class="text-blue-600">Home</a></li>
                    <li class="mx-2">/</li>
                    <li class="text-gray-700 capitalize">{{ $category }}</li>
                </ol>
            </nav>
            <h1 class="text-2xl font-semibold capitalize">{{ $category }} Category</h1>
            <!-- Category product list would go here -->
        </div>
    </div>
</x-app-layout>
