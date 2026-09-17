<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View FAQ" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.faqs.index')">Back</x-button>
            <x-button :href="route('admin.faqs.edit', $faq)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <p class="font-semibold">{{ $faq->question }}</p>
        <p class="mt-3 whitespace-pre-line text-text-2">{{ $faq->answer }}</p>
        <p class="mt-3 text-sm">Category: {{ $faq->category ?: '—' }}</p>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <div class="flex gap-2">
            <x-status-badge :tone="$faq->is_active ? 'success' : 'muted'" :label="$faq->is_active ? 'Active' : 'Hidden'" />
            @if ($faq->is_featured)
                <x-status-badge tone="warning" label="Featured" />
            @endif
        </div>
    </x-card>
</div>
