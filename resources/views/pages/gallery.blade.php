@php
    $title = 'Gallery';
    $description = 'Photographs published by Horizonion Microcare Association.';
@endphp

@extends('layouts.public')

@section('content')
    @include('layouts.partials.breadcrumbs', ['crumbs' => ['Gallery' => null]])

    <section class="container-site py-12 md:py-16">
        <x-section-heading
            eyebrow="{{ $site->get('general.company_name') }}"
            heading="Community and field gallery"
            intro="Photographs published from the Super Admin. Images appear here only when they are marked active."
        />

        @if ($images->isEmpty())
            <x-empty-state class="mt-10" title="No gallery images yet" actionLabel="Contact us" actionUrl="{{ route('contact') }}">
                Published photographs will appear here once they are added from the Super Admin.
            </x-empty-state>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($images as $image)
                    <figure class="overflow-hidden rounded-xl border border-border bg-surface shadow-sm">
                        <img
                            src="{{ $image->imageUrl() }}"
                            alt="{{ $image->alt_text }}"
                            class="aspect-[4/3] w-full object-cover"
                        >
                        <figcaption class="p-5">
                            @if ($image->category)
                                <p class="text-sm font-medium text-accent">{{ $image->category->name }}</p>
                            @endif
                            <h2 class="mt-1 text-lg text-primary">{{ $image->title }}</h2>
                            @if (filled($image->description))
                                <p class="mt-2 text-sm text-text-secondary">{{ $image->description }}</p>
                            @endif
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        @endif
    </section>
@endsection
