@php
    $title = 'Our Mission';
    $description = 'Mission, vision, and values of Horizonion Microcare Association. We share responsible loan information and never guarantee a loan.';
@endphp

@extends('layouts.public')

@section('content')
    @include('layouts.partials.breadcrumbs', ['crumbs' => ['Our Mission' => null]])

    <section class="relative overflow-hidden bg-primary text-white">
        <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <p class="text-sm font-semibold tracking-[0.18em] text-accent uppercase">Mission, vision, values</p>
                <h1 class="mt-4 max-w-xl text-4xl leading-tight md:text-5xl">
                    Clear information. Responsible support. No hidden promises.
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-white/80">
                    Our work is to help women and families understand livelihood finance, how to enquire, and how decisions are reviewed. A conversation or application does not guarantee a loan.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-button href="{{ route('about') }}" size="lg">About the association</x-button>
                    <x-button href="{{ route('contact') }}" variant="secondary-inverse" size="lg">
                        Talk to us
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
                eyebrow="Mission"
                heading="Help women access responsible financial information"
                intro="We exist so women-led livelihoods can find a clear path: ask a question, understand the steps, and submit only what is needed. Approval is decided by the organization, not by this website."
            />
            <x-card class="bg-background">
                <p class="font-serif text-2xl text-primary">What this means in practice</p>
                <p class="mt-4 text-sm leading-6 text-text-secondary">
                    We publish how to enquire, what an application involves, and how to reach the office. We do not publish interest rates, eligibility promises, or regulatory claims that the association has not verified.
                </p>
                <p class="mt-4 text-sm leading-6 text-text-secondary">
                    Every enquiry is a request for information. Every application is a request for review. Neither one confirms a loan.
                </p>
            </x-card>
        </div>
    </section>

    <section class="bg-surface">
        <div class="container-site grid items-center gap-10 py-16 lg:grid-cols-2">
            <div>
                <x-section-heading
                    eyebrow="Vision"
                    heading="Communities that can trust the process"
                    intro="We want women and families to meet financial information that is honest, local, and easy to follow — so they can decide for themselves whether to enquire or apply."
                />
            </div>
            <x-card>
                <p class="font-serif text-2xl text-primary">A longer view</p>
                <p class="mt-4 text-sm leading-6 text-text-secondary">
                    Stronger livelihoods grow when people understand the steps, the documents, and the limits of what a website can promise. We aim to be that clear front door, while the association reviews each case on its own.
                </p>
            </x-card>
        </div>
    </section>

    <section class="container-site py-16">
        <x-section-heading
            eyebrow="Values"
            heading="Trust, growth, and community"
            intro="These principles shape how we write, how we answer, and how we treat every enquiry."
        />
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <x-card>
                <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Trust</p>
                <h3 class="mt-3 text-xl text-primary">Say only what we can stand behind</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    If a figure, rate, or claim is not ready, we say so. Visitors should never have to guess whether a statement is official.
                </p>
            </x-card>
            <x-card>
                <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Growth</p>
                <h3 class="mt-3 text-xl text-primary">Support livelihoods, not shortcuts</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    Information should help women-led work, household income, education, and community activity — without implying a guaranteed outcome.
                </p>
            </x-card>
            <x-card>
                <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Community</p>
                <h3 class="mt-3 text-xl text-primary">Stay accountable to the people we serve</h3>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    Consent, grievance channels, and office contact stay visible. Field work and review remain with the association.
                </p>
            </x-card>
        </div>
    </section>

    <section class="bg-surface">
        <div class="container-site py-16">
            <x-section-heading
                eyebrow="Responsible lending"
                heading="Principles we will not hide"
                intro="These limits stay on every public page that talks about finance."
            />
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <x-card>
                    <h3 class="text-xl text-primary">No guaranteed approval</h3>
                    <p class="mt-2 text-sm leading-6 text-text-secondary">
                        Visiting this site, sending an enquiry, or submitting an application never confirms a loan, a rate, or a disbursement.
                    </p>
                </x-card>
                <x-card>
                    <h3 class="text-xl text-primary">Review stays with the association</h3>
                    <p class="mt-2 text-sm leading-6 text-text-secondary">
                        This website collects questions and applications. Decisions are made by the organization after it has the information it needs.
                    </p>
                </x-card>
                <x-card>
                    <h3 class="text-xl text-primary">Ask when something is unclear</h3>
                    <p class="mt-2 text-sm leading-6 text-text-secondary">
                        Use the contact page for office hours, documents, or process questions. A reply is guidance, not an offer.
                    </p>
                </x-card>
            </div>
        </div>
    </section>

    <section class="bg-primary py-14 text-white">
        <div class="container-site flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl">Ready to take the next step?</h2>
                <p class="mt-2 max-w-xl text-white/80">
                    Send an enquiry or start an application. Neither step guarantees a loan, rate, or approval.
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
