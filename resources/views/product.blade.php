<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="list-reset flex">
                    <li><a href="{{ route('home') }}" class="text-blue-600">Home</a></li>
                    <li class="mx-2">/</li>
                    <li><a href="{{ route('categories.show', $category) }}" class="text-blue-600 capitalize">{{ $category }}</a></li>
                    <li class="mx-2">/</li>
                    <li class="text-gray-700 capitalize">{{ $product }}</li>
                </ol>
            </nav>
            <h1 class="text-2xl font-semibold capitalize">{{ $product }}</h1>
            <!-- Product details would go here -->
        </div>
    </div>
</x-app-layout>
