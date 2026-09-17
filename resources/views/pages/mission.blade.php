<x-public-layout
    title="Our mission"
    :breadcrumbs="[['label' => 'Our mission']]"
>
    <section class="bg-navy py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange">Mission, vision & values</p>
            <h1 class="mt-4 max-w-3xl font-serif text-4xl md:text-6xl">Help women take the next practical step.</h1>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <div class="grid gap-8 lg:grid-cols-2">
            <x-card>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-orange">Mission</p>
                <h2 class="mt-3 font-serif text-3xl text-navy">Make livelihood loan information easy to find and honest to read.</h2>
                <p class="mt-4 text-text-2">We publish the products we can help you enquire about, collect applications with clear consent, and follow up as a conversation — not as a promise of money.</p>
            </x-card>
            <x-card>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-orange">Vision</p>
                <h2 class="mt-3 font-serif text-3xl text-navy">Communities where women can ask for support without fear of being misled.</h2>
                <p class="mt-4 text-text-2">We want every visitor to leave knowing what happens next: a human review, possible questions, and no automatic approval from this website.</p>
            </x-card>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['title' => 'Clarity', 'body' => 'Plain language. No invented figures. No implied regulatory status.'],
                ['title' => 'Care', 'body' => 'Forms include consent and a reminder that submission is not a guarantee.'],
                ['title' => 'Community', 'body' => 'Stories and photographs stay specific, named, and respectful.'],
            ] as $value)
                <x-card>
                    <h3 class="font-serif text-2xl text-navy">{{ $value['title'] }}</h3>
                    <p class="mt-3 text-text-2">{{ $value['body'] }}</p>
                </x-card>
            @endforeach
        </div>
    </section>
</x-public-layout>
