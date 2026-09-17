<x-public-layout title="Home" :lightbox="true">
    <section
        x-data="{
            active: 0,
            count: {{ $slides->count() }},
            paused: false,
            next() { if (this.count) this.active = (this.active + 1) % this.count },
            prev() { if (this.count) this.active = (this.active - 1 + this.count) % this.count },
        }"
        x-init="if (count > 1) setInterval(() => { if (! paused) next() }, 7000)"
        x-on:mouseenter="paused = true"
        x-on:mouseleave="paused = false"
        class="hero-slider bg-navy"
    >
        @forelse ($slides as $index => $slide)
            <div x-show="active === {{ $index }}" x-transition.opacity class="hero-slider-slide" @if ($index !== 0) x-cloak @endif>
                <img src="{{ $slide->imageUrl() }}" alt="" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/80 to-navy/40"></div>
                <div class="relative mx-auto flex min-h-[36rem] max-w-7xl flex-col justify-center px-4 py-20 md:min-h-[44rem] md:px-6">
                    @if ($slide->kicker)
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-orange">{{ $slide->kicker }}</p>
                    @endif
                    <h1 class="mt-4 max-w-3xl font-serif text-5xl leading-tight text-white md:text-7xl">{{ $slide->heading }}</h1>
                    @if ($slide->text)
                        <p class="mt-5 max-w-2xl text-lg text-white/80">{{ $slide->text }}</p>
                    @endif
                    @if ($slide->cta_label && $slide->cta_url)
                        <div class="mt-8">
                            <x-button :href="$slide->cta_url">{{ $slide->cta_label }}</x-button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="relative min-h-[36rem] bg-navy md:min-h-[44rem]">
                <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy to-orange/30"></div>
                <div class="relative mx-auto flex min-h-[36rem] max-w-7xl flex-col justify-center px-4 py-20 md:min-h-[44rem] md:px-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-orange">{{ $site->tagline }}</p>
                    <h1 class="mt-4 max-w-3xl font-serif text-5xl leading-tight text-white md:text-7xl">Livelihood support for women, shared with care.</h1>
                    <p class="mt-5 max-w-2xl text-lg text-white/80">Explore loan types, stories from the community, and start an application. Submitting a form never guarantees a loan or approval.</p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <x-button :href="route('apply')">{{ __('Apply for Loan') }}</x-button>
                        <x-button variant="secondary" class="border-white text-white hover:bg-white hover:text-navy" :href="route('offerings.index')">{{ __('Our offerings') }}</x-button>
                    </div>
                </div>
            </div>
        @endforelse

        @if ($slides->count() > 1)
            <x-slider-arrow direction="prev" x-on:click="prev()" />
            <x-slider-arrow direction="next" x-on:click="next()" />
        @endif
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div>
                <x-section-heading
                    :eyebrow="__('Women first')"
                    title="Capital should follow courage, not the other way around."
                    description="Horizonion Microcare Association exists so women can ask about livelihood and self-empowerment loans without being promised an outcome. We share information, collect applications, and connect people with the next conversation."
                />
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-button :href="route('offerings.index')">{{ __('See offerings') }}</x-button>
                    <x-button variant="secondary" :href="route('apply')">{{ __('Apply for Loan') }}</x-button>
                </div>
            </div>
            <x-card class="bg-navy text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-orange">{{ __('What this site does') }}</p>
                <ul class="mt-5 space-y-3 text-white/80">
                    <li>Explains loan types we help you enquire about</li>
                    <li>Collects applications and contact details for follow-up</li>
                    <li>Shares stories and community photographs</li>
                    <li>Never guarantees a loan, interest rate, or approval</li>
                </ul>
            </x-card>
        </div>
    </section>

    <section class="bg-surface py-20">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <div class="flex items-end justify-between gap-6">
                <x-section-heading :eyebrow="__('Our offerings')" title="Livelihood products, explained simply." />
                <x-button variant="secondary" :href="route('offerings.index')">{{ __('View all') }}</x-button>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($products as $product)
                    <x-card class="flex flex-col shadow-md transition hover:-translate-y-0.5 hover:shadow-lg">
                        <h3 class="font-serif text-2xl text-navy">{{ $product->name }}</h3>
                        <p class="mt-3 flex-1 text-text-2">{{ $product->short_description }}</p>
                        <div class="mt-6 flex gap-3">
                            <x-button :href="route('apply', ['product' => $product->id])">{{ __('Apply for Loan') }}</x-button>
                            <x-button variant="ghost" :href="route('offerings.show', $product)">{{ __('Details') }}</x-button>
                        </div>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6" x-data="{ active: 0, count: {{ $stories->count() }} }">
        <div class="flex items-end justify-between gap-6">
            <x-section-heading :eyebrow="__('Client stories')" title="Voices from the community." />
            <x-button variant="secondary" :href="route('stories.index')">{{ __('View all') }}</x-button>
        </div>
        @if ($stories->isNotEmpty())
            <div class="relative mt-10 min-h-[22rem]">
                @foreach ($stories as $index => $story)
                    <article x-show="active === {{ $index }}" x-transition.opacity class="grid items-center gap-8 rounded-xl border border-border bg-surface p-6 shadow-md md:grid-cols-[18rem_1fr] md:p-10" @if ($index !== 0) x-cloak @endif>
                        <img src="{{ $story->photoUrl() }}" alt="{{ $story->name }}" class="h-64 w-full rounded-xl object-cover">
                        <div>
                            <blockquote class="font-serif text-2xl text-navy">“{{ $story->feedback }}”</blockquote>
                            <p class="mt-6 font-semibold">{{ $story->name }}</p>
                            <p class="text-sm text-text-2">{{ $story->location }}</p>
                        </div>
                    </article>
                @endforeach
                @if ($stories->count() > 1)
                    <x-slider-arrow direction="prev" x-on:click="active = (active - 1 + count) % count" />
                    <x-slider-arrow direction="next" x-on:click="active = (active + 1) % count" />
                @endif
            </div>
        @endif
    </section>

    @if ($site->ceo_name)
        <section class="bg-navy py-20 text-white">
            <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 md:grid-cols-[18rem_1fr] md:px-6">
                @if ($site->ceoPhotoUrl())
                    <img src="{{ $site->ceoPhotoUrl() }}" alt="{{ $site->ceo_name }}" class="h-72 w-full rounded-xl object-cover">
                @endif
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange">{{ __('From the leadership desk') }}</p>
                    <h2 class="mt-3 font-serif text-4xl">{{ $site->ceo_name }}</h2>
                    <p class="mt-1 text-white/70">{{ $site->ceo_designation }}</p>
                    <p class="mt-6 max-w-3xl whitespace-pre-line leading-relaxed text-white/80">{{ $site->ceo_bio }}</p>
                </div>
            </div>
        </section>
    @endif

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <div class="flex items-end justify-between gap-6">
            <x-section-heading :eyebrow="__('Gallery')" title="Moments from the field." />
            <x-button variant="secondary" :href="route('gallery')">{{ __('View more') }}</x-button>
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ($galleryImages as $image)
                <a href="{{ $image->imageUrl() }}" class="glightbox group overflow-hidden rounded-xl border border-border bg-surface shadow-sm" data-gallery="home-gallery" data-title="{{ $image->label }}">
                    <img src="{{ $image->imageUrl() }}" alt="{{ $image->alt_text }}" class="h-40 w-full object-cover transition duration-300 group-hover:scale-105">
                    <p class="px-3 py-2 text-sm font-semibold text-navy">{{ $image->label }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-surface py-20">
        <div class="mx-auto max-w-4xl px-4 md:px-6">
            <div class="flex items-end justify-between gap-6">
                <x-section-heading :eyebrow="__('FAQs')" title="Questions people ask first." />
                <x-button variant="secondary" :href="route('faqs')">{{ __('All FAQs') }}</x-button>
            </div>
            <div class="mt-10 space-y-3" x-data="{ open: 0 }">
                @foreach ($faqs as $index => $faq)
                    <div class="rounded-xl border border-border bg-paper shadow-sm">
                        <button type="button" class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left font-semibold" x-on:click="open = open === {{ $index }} ? null : {{ $index }}">
                            <span>{{ $faq->question }}</span>
                            <x-ui-icon name="chevron-down" class="h-5 w-5 shrink-0 text-orange transition" x-bind:class="open === {{ $index }} ? 'rotate-180' : ''" />
                        </button>
                        <div x-show="open === {{ $index }}" x-cloak class="px-5 pb-5 text-text-2">{{ $faq->answer }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 md:px-6">
        <x-card class="flex flex-col items-start justify-between gap-6 bg-navy text-white shadow-xl md:flex-row md:items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-orange">{{ __('Ready when you are') }}</p>
                <h2 class="mt-2 font-serif text-3xl">Start an application or send an enquiry.</h2>
                <p class="mt-3 max-w-xl text-white/75">We will read what you send and follow up if we need more information. Nothing here is a loan offer or a guarantee of approval.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <x-button :href="route('apply')">{{ __('Apply for Loan') }}</x-button>
                <x-button variant="secondary" class="border-white text-white hover:bg-white hover:text-navy" :href="route('contact')">{{ __('Contact us') }}</x-button>
            </div>
        </x-card>
    </section>
</x-public-layout>
