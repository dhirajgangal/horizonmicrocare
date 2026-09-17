<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading :title="__('View slide')" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.home-slides.index')">{{ __('Back') }}</x-button>
            <x-button :href="route('admin.home-slides.edit', $homeSlide)">{{ __('Edit') }}</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
        <dl class="grid gap-4 md:grid-cols-2">
            <div><dt class="field-kicker">{{ __('Kicker') }}</dt><dd class="font-semibold">{{ $homeSlide->kicker ?: '—' }}</dd></div>
            <div><dt class="field-kicker">{{ __('Heading') }}</dt><dd class="font-semibold">{{ $homeSlide->heading }}</dd></div>
            <div class="md:col-span-2"><dt class="field-kicker">{{ __('Text') }}</dt><dd>{{ $homeSlide->text ?: '—' }}</dd></div>
            <div><dt class="field-kicker">{{ __('CTA') }}</dt><dd>{{ $homeSlide->cta_label ?: '—' }} {{ $homeSlide->cta_url }}</dd></div>
            <div><dt class="field-kicker">{{ __('Order') }}</dt><dd>{{ $homeSlide->sort_order }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Media') }}</h3>
        <img src="{{ $homeSlide->imageUrl() }}" alt="" class="max-h-72 rounded-xl object-cover">
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
        <x-status-badge :tone="$homeSlide->is_active ? 'success' : 'muted'" :label="$homeSlide->is_active ? __('Active') : __('Hidden')" />
    </x-card>
</div>
