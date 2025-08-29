@props(['images' => [], 'colors' => []])

<div {{ $attributes->merge(['class' => 'product-gallery']) }} data-images='@json($images)' data-colors='@json($colors)'>
    <div class="relative overflow-hidden w-full h-full">
        <img class="pg-image w-full h-full object-cover cursor-grab" src="{{ $images[0] ?? '' }}" alt="">
    </div>
    @if(!empty($colors))
        <div class="flex space-x-2 mt-2">
            @foreach($colors as $color => $frames)
                <button class="pg-color w-6 h-6 rounded-full border" data-color="{{ $color }}" style="background-color: {{ $color }}"></button>
            @endforeach
        </div>
    @endif
</div>

@once
    <script src="https://unpkg.com/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.product-gallery').forEach(function (gallery) {
                let frames = JSON.parse(gallery.dataset.images || '[]');
                const colorData = JSON.parse(gallery.dataset.colors || '{}');
                let currentFrames = frames;
                let index = 0;
                const img = gallery.querySelector('.pg-image');
                let dragging = false;
                let startX = 0;
                if (img && window.mediumZoom) {
                    mediumZoom(img);
                }
                img?.addEventListener('mousedown', function (e) {
                    dragging = true;
                    startX = e.clientX;
                    e.preventDefault();
                });
                img?.addEventListener('mouseup', function () {
                    dragging = false;
                });
                img?.addEventListener('mouseleave', function () {
                    dragging = false;
                });
                img?.addEventListener('mousemove', function (e) {
                    if (!dragging || currentFrames.length === 0) return;
                    const dx = e.clientX - startX;
                    if (Math.abs(dx) > 5) {
                        index = (index + (dx > 0 ? 1 : -1) + currentFrames.length) % currentFrames.length;
                        img.src = currentFrames[index];
                        startX = e.clientX;
                    }
                });
                gallery.querySelectorAll('.pg-color').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        const color = btn.dataset.color;
                        if (colorData[color]) {
                            currentFrames = colorData[color];
                            index = 0;
                            img.src = currentFrames[0];
                        }
                    });
                });
            });
        });
    </script>
@endonce
