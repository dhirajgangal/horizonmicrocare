<x-public-layout
    :title="$story->name"
    :breadcrumbs="[
        ['label' => __('Client stories'), 'url' => route('stories.index')],
        ['label' => $story->name],
    ]"
>
    <section class="mx-auto max-w-4xl px-4 py-16 md:px-6">
        <img src="{{ $story->photoUrl() }}" alt="{{ $story->name }}" class="h-80 w-full rounded-xl object-cover">
        <h1 class="mt-8 font-serif text-4xl text-navy">{{ $story->name }}</h1>
        @if ($story->location)
            <p class="mt-2 text-text-2">{{ $story->location }}</p>
        @endif
        <blockquote class="mt-8 border-l-4 border-orange pl-5 font-serif text-2xl text-navy">“{{ $story->feedback }}”</blockquote>
        <div class="mt-10">
            <x-button variant="secondary" :href="route('stories.index')">{{ __('All stories') }}</x-button>
        </div>
    </section>
</x-public-layout>
