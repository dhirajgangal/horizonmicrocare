<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View slide" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.home-slides.index')">Back</x-button>
            <x-button :href="route('admin.home-slides.edit', $homeSlide)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <dl class="grid gap-4 md:grid-cols-2">
            <div><dt class="text-xs uppercase text-text-2">Kicker</dt><dd class="font-semibold">{{ $homeSlide->kicker ?: '—' }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Heading</dt><dd class="font-semibold">{{ $homeSlide->heading }}</dd></div>
            <div class="md:col-span-2"><dt class="text-xs uppercase text-text-2">Text</dt><dd>{{ $homeSlide->text ?: '—' }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">CTA</dt><dd>{{ $homeSlide->cta_label ?: '—' }} {{ $homeSlide->cta_url }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Order</dt><dd>{{ $homeSlide->sort_order }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Media</h3>
        <img src="{{ $homeSlide->imageUrl() }}" alt="" class="max-h-72 rounded-xl object-cover">
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <x-status-badge :tone="$homeSlide->is_active ? 'success' : 'muted'" :label="$homeSlide->is_active ? 'Active' : 'Hidden'" />
    </x-card>
</div>
