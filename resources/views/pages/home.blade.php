@php
    $title = 'Home';
    $description = $site->get('seo.default_description');
@endphp

@extends('layouts.public')

@section('content')
    <section class="relative overflow-hidden bg-primary text-white">
        <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <p class="text-sm font-semibold tracking-[0.18em] text-accent uppercase">Women. Livelihoods. Community.</p>
                <h1 class="mt-4 max-w-xl text-4xl leading-tight md:text-5xl">
                    Financial opportunities that help women build stronger communities.
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-white/80">
                    Horizonion Microcare Association is building a clear, trustworthy home for responsible loan information and support. Content on this site is being prepared and will be managed from the Super Admin.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-button href="{{ route('loans.index') }}" size="lg">Explore Our Loans</x-button>
                    <x-button href="{{ route('apply') }}" variant="secondary-inverse" size="lg">
                        Apply for a Loan
                    </x-button>
                </div>
            </div>
            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10">
                <img
                    src="{{ $site->logoUrl('rectangle') }}"
                    alt="{{ $site->get('general.company_name') }}"
                    class="mx-auto w-full max-w-md rounded-lg bg-white p-6"
                >
                <p class="mt-4 text-center text-sm text-white/70">
                    Official figures, stories, and product details will appear here after they are published by the organization.
                </p>
            </div>
        </div>
    </section>

    <section class="container-site py-16">
        <x-section-heading
            eyebrow="Impact"
            heading="Trust begins with transparent numbers"
            intro="Statistics will be managed from the Super Admin. Placeholder tiles are shown until official figures are available."
        />
        <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <x-stat label="Women supported" value="To be published" />
            <x-stat label="Loans disbursed" value="To be published" />
            <x-stat label="Communities reached" value="To be published" />
            <x-stat label="Service areas" value="To be published" />
        </div>
    </section>

    <section class="bg-surface">
        <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-2">
            <div>
                <x-section-heading
                    eyebrow="Women empowerment"
                    heading="Creating financial opportunities for women"
                    intro="Access to responsible financial services can support small businesses, household income, self-employment, education, and community development. The full section copy and image will be editable from the CMS."
                />
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-button href="{{ route('mission') }}">Read our mission</x-button>
                    <x-button href="{{ route('contact') }}" variant="secondary">Talk to us</x-button>
                </div>
            </div>
            <x-card class="bg-background">
                <p class="font-serif text-2xl text-primary">A community-first institution in the making.</p>
                <p class="mt-4 text-text-secondary">
                    We will not publish interest rates, approval promises, or regulatory claims until the organization supplies verified information.
                </p>
            </x-card>
        </div>
    </section>

    <section class="container-site py-16">
        <x-section-heading
            eyebrow="Next"
            heading="A complete public site, built in phases"
            intro="Loan products, client stories, gallery, FAQs, and applications will be connected to the Super Admin in the next implementation phases."
        />
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <x-card>
                <h3 class="text-xl text-primary">Our offerings</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">Configurable loan products with honest placeholders where details are not yet available.</p>
            </x-card>
            <x-card>
                <h3 class="text-xl text-primary">How it works</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">A step-by-step process that never implies guaranteed approval.</p>
            </x-card>
            <x-card>
                <h3 class="text-xl text-primary">Apply with confidence</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">A mobile-first form, reference numbers, and consent records — coming in a later phase.</p>
            </x-card>
        </div>
    </section>

    <section class="bg-primary py-14 text-white">
        <div class="container-site flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl">Ready to start a conversation?</h2>
                <p class="mt-2 max-w-xl text-white/80">Use the contact page for general enquiries. Loan applications will open when the organization publishes the form.</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <x-button href="{{ route('apply') }}" size="lg">Apply for a Loan</x-button>
                <x-button href="{{ route('contact') }}" variant="secondary-inverse" size="lg">
                    Contact us
                </x-button>
            </div>
        </div>
    </section>
@endsection
