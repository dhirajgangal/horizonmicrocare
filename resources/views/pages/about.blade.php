@php
    $title = 'About Us';
    $description = 'Learn about Horizonion Microcare Association, a women-focused financial inclusion initiative that shares responsible loan information and support.';
@endphp

@extends('layouts.public')

@section('content')
    @include('layouts.partials.breadcrumbs', ['crumbs' => ['About Us' => null]])

    <section class="relative overflow-hidden bg-primary text-white">
        <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <p class="text-sm font-semibold tracking-[0.18em] text-accent uppercase">About the association</p>
                <h1 class="mt-4 max-w-xl text-4xl leading-tight md:text-5xl">
                    Financial opportunities that help women build stronger communities.
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-white/80">
                    Horizonion Microcare Association is a women-focused financial inclusion initiative. We publish clear information about livelihood finance, how to enquire, and how decisions are reviewed — without promising a loan.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-button href="{{ route('contact') }}" size="lg">Talk to us</x-button>
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
                <p class="mt-4 text-center text-sm font-medium text-accent">{{ $site->get('general.tagline') }}</p>
            </div>
        </div>
    </section>

    <section class="container-site py-16">
        <div class="grid items-start gap-10 lg:grid-cols-2">
            <x-section-heading
                eyebrow="Our story"
                heading="A community-first institution"
                intro="We exist to help women and families understand responsible financial options for small businesses, household income, self-employment, and community development. Every enquiry is a request for information. Approval is decided by the organization, not by this website."
            />
            <x-card class="bg-background">
                <p class="font-serif text-2xl text-primary">Who we are</p>
                <p class="mt-4 text-sm leading-6 text-text-secondary">
                    Horizonion Microcare Association is a women-focused financial inclusion initiative. We help communities access responsible loan information and support, and we keep every public statement honest.
                </p>
                <p class="mt-4 text-sm leading-6 text-text-secondary">
                    We do not publish interest rates, approval promises, or regulatory claims that have not been verified by the organization.
                </p>
            </x-card>
        </div>
    </section>

    <section class="bg-surface">
        <div class="container-site py-16">
            <x-section-heading
                eyebrow="What we do"
                heading="Clear information before any application"
                intro="Visitors can learn how livelihood support works, ask a question, and start an application when they are ready. None of those steps guarantees a loan."
            />
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <x-card>
                    <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Livelihoods</p>
                    <h3 class="mt-3 text-xl text-primary">Support for women-led work</h3>
                    <p class="mt-2 text-sm leading-6 text-text-secondary">
                        We share information that can help women explore finance for small businesses, household income, education, and community activity.
                    </p>
                </x-card>
                <x-card>
                    <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Process</p>
                    <h3 class="mt-3 text-xl text-primary">A path you can follow</h3>
                    <p class="mt-2 text-sm leading-6 text-text-secondary">
                        Enquire, review the published steps, submit only the details that are needed, and wait for the organization to respond.
                    </p>
                </x-card>
                <x-card>
                    <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Responsibility</p>
                    <h3 class="mt-3 text-xl text-primary">No hidden promises</h3>
                    <p class="mt-2 text-sm leading-6 text-text-secondary">
                        Consent, grievance channels, and honest disclaimers stay visible. A submitted form never implies approval, a rate, or a disbursement.
                    </p>
                </x-card>
            </div>
        </div>
    </section>

    <section class="container-site py-16">
        <x-section-heading
            eyebrow="Values"
            heading="Trust, growth, and community"
            intro="These principles guide how we speak about finance and how we treat every enquiry."
        />
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <x-card>
                <h3 class="text-xl text-primary">Trust</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    We publish only what the association can stand behind, and we say clearly when a detail is still being prepared.
                </p>
            </x-card>
            <x-card>
                <h3 class="text-xl text-primary">Growth</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    Access to responsible information can support livelihoods, household stability, and longer-term community development.
                </p>
            </x-card>
            <x-card>
                <h3 class="text-xl text-primary">Community</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    Women, families, and local partners come first. Leadership and field work stay accountable to the people we serve.
                </p>
            </x-card>
        </div>
    </section>

    <section class="bg-surface">
        <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-2">
            <div>
                <x-section-heading
                    eyebrow="Leadership"
                    heading="A team that stays close to the community"
                    intro="The association is guided by people who review enquiries, explain the process, and keep published information accurate. For officer names and office hours, use the contact page."
                />
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-button href="{{ route('contact') }}">Contact the office</x-button>
                    <x-button href="{{ route('mission') }}" variant="secondary">Read our mission</x-button>
                </div>
            </div>
            <x-card>
                <p class="font-serif text-2xl text-primary">How decisions are made</p>
                <p class="mt-4 text-sm leading-6 text-text-secondary">
                    Applications and enquiries are reviewed by the organization. This website collects questions and applications; it does not approve loans, set rates, or confirm eligibility on its own.
                </p>
            </x-card>
        </div>
    </section>

    <section class="bg-primary py-14 text-white">
        <div class="container-site flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl">Want to know more?</h2>
                <p class="mt-2 max-w-xl text-white/80">
                    Send an enquiry or start an application. A conversation does not guarantee a loan, rate, or approval.
                </p>
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
