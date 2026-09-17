<x-public-layout
    :title="__('Our mission')"
    :breadcrumbs="[['label' => __('Our mission')]]"
>
    <section class="bg-navy py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <p class="text-xs font-semibold text-orange">{{ __('Mission, vision & values') }}</p>
            <h1 class="mt-4 max-w-3xl font-serif text-4xl md:text-6xl">{{ __('Help women take the next practical step.') }}</h1>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <div class="grid gap-8 lg:grid-cols-2">
            <x-card>
                <p class="text-xs font-semibold text-orange">{{ __('Mission') }}</p>
                <h2 class="mt-3 font-serif text-3xl text-navy">{{ __('Make livelihood loan information easy to find and honest to read.') }}</h2>
                <p class="mt-4 text-text-2">{{ __('We publish the products we can help you enquire about, collect applications with clear consent, and follow up as a conversation — not as a promise of money.') }}</p>
            </x-card>
            <x-card>
                <p class="text-xs font-semibold text-orange">{{ __('Vision') }}</p>
                <h2 class="mt-3 font-serif text-3xl text-navy">{{ __('Communities where women can ask for support without fear of being misled.') }}</h2>
                <p class="mt-4 text-text-2">{{ __('We want every visitor to leave knowing what happens next: a human review, possible questions, and no automatic approval from this website.') }}</p>
            </x-card>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['title' => __('Clarity'), 'body' => __('Plain language. No invented figures. No implied regulatory status.')],
                ['title' => __('Care'), 'body' => __('Forms include consent and a reminder that submission is not a guarantee.')],
                ['title' => __('Community'), 'body' => __('Stories and photographs stay specific, named, and respectful.')],
            ] as $value)
                <x-card>
                    <h3 class="font-serif text-2xl text-navy">{{ $value['title'] }}</h3>
                    <p class="mt-3 text-text-2">{{ $value['body'] }}</p>
                </x-card>
            @endforeach
        </div>
    </section>
</x-public-layout>
