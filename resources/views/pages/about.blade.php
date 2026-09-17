<x-public-layout
    :title="__('About us')"
    :breadcrumbs="[['label' => __('About us')]]"
>
    <section class="bg-navy py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <p class="text-xs font-semibold text-orange">{{ __('About us') }}</p>
            <h1 class="mt-4 max-w-3xl font-serif text-4xl md:text-6xl">{{ __('A women-focused association for livelihood conversations.') }}</h1>
            <p class="mt-6 max-w-2xl text-lg text-white/75">{{ __('Horizonion Microcare Association helps women learn about livelihood and self-empowerment loan options, share their stories, and start an application. We do not promise a loan, a rate, or an approval on this website.') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <div class="grid gap-10 lg:grid-cols-2">
            <x-section-heading
                :eyebrow="__('Our story')"
                :title="__('Information first. Dignity always.')"
                :description="__('Many women already run a trade, a farm, or a household enterprise. What they often need is a clear place to ask for support without being sold a guaranteed outcome. This site is that place: offerings, stories, and a careful application form.')"
            />
            <x-card>
                <ul class="space-y-4 text-text-2">
                    <li><strong class="text-navy">{{ __('We listen first.') }}</strong> {{ __('Applications and enquiries are requests for a conversation.') }}</li>
                    <li><strong class="text-navy">{{ __('We stay plain.') }}</strong> {{ __('No invented interest rates or regulatory claims.') }}</li>
                    <li><strong class="text-navy">{{ __('We stay local.') }}</strong> {{ __('Community photographs and stories keep the work grounded.') }}</li>
                </ul>
            </x-card>
        </div>
    </section>

    <section class="bg-surface py-20">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 md:grid-cols-3 md:px-6">
            @foreach ([
                ['title' => __('Trust'), 'body' => __('We say what the website can and cannot do. A submitted form is never a loan.')],
                ['title' => __('Growth'), 'body' => __('We highlight livelihood products meant to support work, skills, and household enterprise.')],
                ['title' => __('Community'), 'body' => __('Stories and gallery images belong to the people who shared them, not to a marketing script.')],
            ] as $value)
                <x-card>
                    <h2 class="font-serif text-2xl text-navy">{{ $value['title'] }}</h2>
                    <p class="mt-3 text-text-2">{{ $value['body'] }}</p>
                </x-card>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6">
        <div class="relative overflow-hidden rounded-xl border border-navy bg-navy text-white shadow-xl">
            <div class="absolute inset-y-0 left-0 w-1 bg-orange"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy to-navy/90"></div>
            <div class="relative flex flex-col items-start justify-between gap-6 p-6 md:flex-row md:items-center md:p-8">
                <div>
                    <h2 class="font-serif text-3xl">{{ __('See how we work in practice.') }}</h2>
                    <p class="mt-2 text-white/75">{{ __('Read the mission, browse offerings, or start an application.') }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <x-button :href="route('mission')">{{ __('Our mission') }}</x-button>
                    <x-button variant="secondary" class="border-white text-white hover:bg-white hover:text-navy" :href="route('apply')">{{ __('Apply for Loan') }}</x-button>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
