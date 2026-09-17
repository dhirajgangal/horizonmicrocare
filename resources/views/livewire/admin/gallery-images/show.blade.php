<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading :title="__('View image')" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.gallery.index')">{{ __('Back') }}</x-button>
            <x-button :href="route('admin.gallery.edit', $galleryImage)">{{ __('Edit') }}</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
        <p class="font-semibold">{{ $galleryImage->label }}</p>
        <p class="text-sm text-text-2">{{ $galleryImage->alt_text }}</p>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Media') }}</h3>
        <img src="{{ $galleryImage->imageUrl() }}" alt="{{ $galleryImage->alt_text }}" class="max-h-80 rounded-xl object-cover">
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
        <x-status-badge :tone="$galleryImage->is_active ? 'success' : 'muted'" :label="$galleryImage->is_active ? __('Active') : __('Hidden')" />
    </x-card>
</div>
