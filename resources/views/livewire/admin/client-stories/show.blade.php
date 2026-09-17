<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View story" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.client-stories.index')">Back</x-button>
            <x-button :href="route('admin.client-stories.edit', $clientStory)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <p class="font-semibold">{{ $clientStory->name }}</p>
        <p class="text-sm text-text-2">{{ $clientStory->location ?: '—' }}</p>
        <blockquote class="mt-4 border-l-4 border-orange pl-4 italic">{{ $clientStory->feedback }}</blockquote>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Media</h3>
        <img src="{{ $clientStory->photoUrl() }}" alt="" class="h-48 rounded-xl object-cover">
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <x-status-badge :tone="$clientStory->is_published ? 'success' : 'muted'" :label="$clientStory->is_published ? 'Published' : 'Draft'" />
    </x-card>
</div>
