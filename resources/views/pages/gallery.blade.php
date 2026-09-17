<x-public-layout
    title="Gallery"
    :lightbox="true"
    :breadcrumbs="[['label' => 'Gallery']]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">Gallery</h1>
            <p class="mt-4 max-w-2xl text-white/75">Field photographs and community moments. Click any image to view it larger.</p>
        </div>
    </section>
    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($images as $image)
                <a href="{{ $image->imageUrl() }}" class="glightbox group overflow-hidden rounded-xl border border-border bg-surface shadow-sm" data-gallery="gallery" data-title="{{ $image->label }}">
                    <img src="{{ $image->imageUrl() }}" alt="{{ $image->alt_text }}" class="h-64 w-full object-cover transition duration-300 group-hover:scale-105">
                    <p class="px-4 py-3 text-sm font-semibold text-navy">{{ $image->label }}</p>
                </a>
            @endforeach
        </div>
    </section>
</x-public-layout>
