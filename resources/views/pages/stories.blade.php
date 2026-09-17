<x-public-layout
    :title="__('Client stories')"
    :breadcrumbs="[['label' => __('Client stories')]]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ __('Client stories') }}</h1>
            <p class="mt-4 max-w-2xl text-white/75">{{ __('These accounts are shared in the speaker’s words. They are not guarantees of a similar outcome.') }}</p>
        </div>
    </section>
    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6">
        @livewire('public.stories-index')
    </section>
</x-public-layout>
