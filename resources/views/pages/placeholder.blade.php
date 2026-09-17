@extends('layouts.public')

@section('content')
    @include('layouts.partials.breadcrumbs', ['crumbs' => [$title => null]])

    <section class="container-site py-12 md:py-16">
        <x-section-heading
            eyebrow="{{ $site->get('general.company_name') }}"
            heading="{{ $heading }}"
            intro="{{ $summary }}"
        />

        <x-alert class="mt-8 max-w-3xl">
            This is a Phase 1 placeholder. The Super Admin will manage the published content for this page.
        </x-alert>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <x-button href="{{ route($ctaRoute) }}">{{ $ctaLabel }}</x-button>
            <x-button href="{{ route('home') }}" variant="secondary">Back to home</x-button>
        </div>
    </section>
@endsection
