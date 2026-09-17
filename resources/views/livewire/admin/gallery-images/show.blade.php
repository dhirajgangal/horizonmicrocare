<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View image" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.gallery.index')">Back</x-button>
            <x-button :href="route('admin.gallery.edit', $galleryImage)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <p class="font-semibold">{{ $galleryImage->label }}</p>
        <p class="text-sm text-text-2">{{ $galleryImage->alt_text }}</p>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Media</h3>
        <img src="{{ $galleryImage->imageUrl() }}" alt="{{ $galleryImage->alt_text }}" class="max-h-80 rounded-xl object-cover">
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <x-status-badge :tone="$galleryImage->is_active ? 'success' : 'muted'" :label="$galleryImage->is_active ? 'Active' : 'Hidden'" />
    </x-card>
</div>
