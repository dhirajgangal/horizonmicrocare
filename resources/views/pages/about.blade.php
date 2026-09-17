<x-public-layout
    title="About us"
    :breadcrumbs="[['label' => 'About us']]"
>
    <section class="bg-navy py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange">About us</p>
            <h1 class="mt-4 max-w-3xl font-serif text-4xl md:text-6xl">A women-focused association for livelihood conversations.</h1>
            <p class="mt-6 max-w-2xl text-lg text-white/75">Horizonion Microcare Association helps women learn about livelihood and self-empowerment loan options, share their stories, and start an application. We do not promise a loan, a rate, or an approval on this website.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <div class="grid gap-10 lg:grid-cols-2">
            <x-section-heading
                eyebrow="Our story"
                title="Information first. Dignity always."
                description="Many women already run a trade, a farm, or a household enterprise. What they often need is a clear place to ask for support without being sold a guaranteed outcome. This site is that place: offerings, stories, and a careful application form."
            />
            <x-card>
                <ul class="space-y-4 text-text-2">
                    <li><strong class="text-navy">We listen first.</strong> Applications and enquiries are requests for a conversation.</li>
                    <li><strong class="text-navy">We stay plain.</strong> No invented interest rates or regulatory claims.</li>
                    <li><strong class="text-navy">We stay local.</strong> Community photographs and stories keep the work grounded.</li>
                </ul>
            </x-card>
        </div>
    </section>

    <section class="bg-surface py-20">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 md:grid-cols-3 md:px-6">
            @foreach ([
                ['title' => 'Trust', 'body' => 'We say what the website can and cannot do. A submitted form is never a loan.'],
                ['title' => 'Growth', 'body' => 'We highlight livelihood products meant to support work, skills, and household enterprise.'],
                ['title' => 'Community', 'body' => 'Stories and gallery images belong to the people who shared them, not to a marketing script.'],
            ] as $value)
                <x-card>
                    <h2 class="font-serif text-2xl text-navy">{{ $value['title'] }}</h2>
                    <p class="mt-3 text-text-2">{{ $value['body'] }}</p>
                </x-card>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6">
        <x-card class="flex flex-col items-start justify-between gap-6 bg-navy text-white md:flex-row md:items-center">
            <div>
                <h2 class="font-serif text-3xl">See how we work in practice.</h2>
                <p class="mt-2 text-white/75">Read the mission, browse offerings, or start an application.</p>
            </div>
            <div class="flex gap-3">
                <x-button :href="route('mission')">Our mission</x-button>
                <x-button variant="secondary" class="border-white text-white hover:bg-white hover:text-navy" :href="route('apply')">Apply for Loan</x-button>
            </div>
        </x-card>
    </section>
</x-public-layout>
