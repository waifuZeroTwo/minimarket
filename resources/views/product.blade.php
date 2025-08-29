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
            @php
                $frames = [
                    "https://via.placeholder.com/800?text={$product}+1",
                    "https://via.placeholder.com/800?text={$product}+2",
                    "https://via.placeholder.com/800?text={$product}+3",
                    "https://via.placeholder.com/800?text={$product}+4",
                ];
                $colors = [
                    '#ff0000' => [
                        "https://via.placeholder.com/800/ff0000?text={$product}+red1",
                        "https://via.placeholder.com/800/ff0000?text={$product}+red2",
                        "https://via.placeholder.com/800/ff0000?text={$product}+red3",
                        "https://via.placeholder.com/800/ff0000?text={$product}+red4",
                    ],
                    '#0000ff' => [
                        "https://via.placeholder.com/800/0000ff?text={$product}+blue1",
                        "https://via.placeholder.com/800/0000ff?text={$product}+blue2",
                        "https://via.placeholder.com/800/0000ff?text={$product}+blue3",
                        "https://via.placeholder.com/800/0000ff?text={$product}+blue4",
                    ],
                ];
            @endphp

            <x-product-gallery :images="$frames" :colors="$colors" class="mt-6 max-w-md" />
            <!-- Product details would go here -->
        </div>
    </div>
</x-app-layout>
