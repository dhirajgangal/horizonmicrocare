<div>
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($stories as $story)
            <article class="overflow-hidden rounded-xl border border-border bg-surface shadow-sm">
                <img src="{{ $story->photoUrl() }}" alt="{{ $story->name }}" class="h-56 w-full object-cover">
                <div class="p-6">
                    <h2 class="font-serif text-2xl text-navy">{{ $story->name }}</h2>
                    @if ($story->location)
                        <p class="mt-1 text-sm text-text-2">{{ $story->location }}</p>
                    @endif
                    <blockquote class="mt-4 border-l-4 border-orange pl-4 text-text-2 italic">“{{ \Illuminate\Support\Str::limit($story->feedback, 180) }}”</blockquote>
                    <x-button variant="ghost" class="mt-4 px-0" :href="route('stories.show', $story)">{{ __('Read story') }}</x-button>
                </div>
            </article>
        @endforeach
    </div>

    @if ($hasMore)
        <div class="mt-10 text-center">
            <x-button type="button" wire:click="loadMore">{{ __('Load more') }}</x-button>
        </div>
    @endif
</div>
