@php
    $title = 'Contact Us';
    $description = 'Contact Horizonion Microcare Association for general enquiries. Submission of a message does not guarantee a loan.';
    $phone = $site->get('contact.phone');
    $email = $site->get('contact.email');
    $whatsapp = $site->get('contact.whatsapp');
    $address = $site->get('contact.address');
    $hours = $site->get('contact.office_hours');
    $map = $site->get('contact.map_embed');
    $phoneHref = filled($phone) ? 'tel:'.preg_replace('/[^\d+]/', '', (string) $phone) : null;
    $whatsappDigits = filled($whatsapp) ? preg_replace('/\D+/', '', (string) $whatsapp) : null;
    $mapUrl = is_string($map) && filter_var($map, FILTER_VALIDATE_URL) ? $map : null;

    $officeRows = array_values(array_filter([
        [
            'label' => 'Address',
            'value' => $address,
            'href' => $mapUrl,
            'linkLabel' => 'Open map',
            'icon' => 'map',
        ],
        [
            'label' => 'Office hours',
            'value' => $hours,
            'href' => null,
            'linkLabel' => null,
            'icon' => 'clock',
        ],
        [
            'label' => 'Phone',
            'value' => $phone,
            'href' => $phoneHref,
            'linkLabel' => null,
            'icon' => 'phone',
        ],
        [
            'label' => 'Email',
            'value' => $email,
            'href' => filled($email) ? 'mailto:'.$email : null,
            'linkLabel' => null,
            'icon' => 'mail',
        ],
        [
            'label' => 'WhatsApp',
            'value' => $whatsapp,
            'href' => $whatsappDigits ? 'https://wa.me/'.$whatsappDigits : null,
            'linkLabel' => 'Chat on WhatsApp',
            'icon' => 'chat',
        ],
    ], fn (array $row): bool => filled($row['value'])));
@endphp

@extends('layouts.public')

@section('content')
    @include('layouts.partials.breadcrumbs', ['crumbs' => ['Contact Us' => null]])

    <section class="container-site py-12 lg:py-16">
        <x-section-heading
            eyebrow="Get in touch"
            heading="Contact us"
            intro="Office details are published from the Super Admin. An enquiry is a request for information only and never guarantees a loan."
        />

        <div class="contact-panel mt-10">
            <div class="contact-panel__section">
                <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">Organization</p>
                <h2 class="mt-2 text-2xl text-primary">{{ $site->get('general.company_name') }}</h2>
                <p class="mt-3 text-sm leading-6 text-text-secondary">
                    {{ $site->get('general.short_description') }}
                </p>

                @if ($officeRows !== [])
                    <div class="mt-8 grid gap-5">
                        @foreach ($officeRows as $row)
                            <div class="flex items-start gap-4">
                                <span class="contact-icon" aria-hidden="true">
                                    @switch($row['icon'])
                                        @case('map')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z" />
                                                <circle cx="12" cy="10" r="2.4" />
                                            </svg>
                                            @break
                                        @case('clock')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <circle cx="12" cy="12" r="8" />
                                                <path stroke-linecap="round" d="M12 8v4.5L15 15" />
                                            </svg>
                                            @break
                                        @case('phone')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 3.8h2.3l1.4 3.4-1.8 1.1a12.4 12.4 0 0 0 5.3 5.3l1.1-1.8 3.4 1.4v2.3c0 .7-.6 1.3-1.3 1.3C9.6 16.8 3.2 10.4 3.2 5.1c0-.7.6-1.3 1.3-1.3Z" />
                                            </svg>
                                            @break
                                        @case('mail')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <rect x="3.5" y="5.5" width="17" height="13" rx="2" />
                                                <path stroke-linecap="round" d="m4.5 7.5 7.5 6 7.5-6" />
                                            </svg>
                                            @break
                                        @default
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.8 18.2c3.4 1.7 7.4.8 9.8-1.6 2.7-2.7 3.2-6.7 1.4-9.8l-3 1.2a5.2 5.2 0 0 1-2.4 5.8l-1.2-3-4.6 7.4Z" />
                                            </svg>
                                    @endswitch
                                </span>
                                <div>
                                    <p class="text-xs font-semibold tracking-[0.16em] text-accent uppercase">{{ $row['label'] }}</p>
                                    @if ($row['href'] && ! $row['linkLabel'])
                                        <a href="{{ $row['href'] }}" class="mt-1 inline-flex break-all text-sm font-semibold text-primary hover:text-accent">
                                            {{ $row['value'] }}
                                        </a>
                                    @else
                                        <p class="mt-1 text-sm leading-6 text-primary">{{ $row['value'] }}</p>
                                    @endif
                                    @if ($row['href'] && $row['linkLabel'])
                                        <a
                                            href="{{ $row['href'] }}"
                                            class="mt-1 inline-flex text-sm font-semibold text-accent hover:underline"
                                            @if (str_starts_with((string) $row['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                                        >
                                            {{ $row['linkLabel'] }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="contact-panel__section">
                <h2 class="text-2xl text-primary">Send an enquiry</h2>
                <p class="mt-2 text-sm leading-6 text-text-secondary">
                    Share your question and a team member will respond using the details you provide.
                </p>

                <x-alert type="info" class="mt-5">
                    Sending this form does not guarantee a loan, rate, or approval.
                </x-alert>

                <form method="POST" action="{{ route('inquiries.store') }}" class="contact-panel__form">
                    @csrf

                    <div class="sr-only" aria-hidden="true">
                        <label for="website">Website</label>
                        <input id="website" type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-field name="name" label="Full name" required />
                        <x-field name="email" label="Email address" type="email" required />
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-field name="mobile" label="Mobile" type="tel" />
                        <x-field name="subject" label="Subject" />
                    </div>

                    <x-field name="message" label="Message" type="textarea" required rows="4" />

                    <label class="flex items-start gap-3 text-sm leading-6 text-text-secondary">
                        <input
                            type="checkbox"
                            name="consent"
                            value="1"
                            @checked(old('consent'))
                            class="mt-1 h-4 w-4 rounded-sm border-border text-accent"
                            required
                        >
                        <span>{{ $site->get('consent.text') }}</span>
                    </label>
                    @error('consent')
                        <p class="text-sm text-danger">{{ $message }}</p>
                    @enderror

                    <div class="contact-panel__actions">
                        <x-button type="submit">Send enquiry</x-button>
                        <x-button href="{{ route('apply') }}" variant="secondary">Apply for a Loan</x-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
