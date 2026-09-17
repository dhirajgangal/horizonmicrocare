<x-public-layout
    :title="__('Contact us')"
    :breadcrumbs="[['label' => __('Contact us')]]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ __('Contact us') }}</h1>
            <p class="mt-4 max-w-2xl text-white/75">{{ __('Send an enquiry. We will reply if we need more information. This form does not guarantee a loan or approval.') }}</p>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-16 lg:grid-cols-5 md:px-6">
        <x-card class="lg:col-span-2">
            <h2 class="font-serif text-2xl text-navy">{{ __('Office') }}</h2>
            <dl class="mt-6 space-y-4 text-sm">
                @if ($site->address)
                    <div><dt class="text-text-2">{{ __('Address') }}</dt><dd class="mt-1 whitespace-pre-line font-semibold">{{ $site->address }}</dd></div>
                @endif
                @if ($site->phone)
                    <div><dt class="text-text-2">{{ __('Phone') }}</dt><dd class="mt-1 font-semibold">{{ $site->phone }}</dd></div>
                @endif
                @if ($site->email)
                    <div><dt class="text-text-2">{{ __('Email') }}</dt><dd class="mt-1 font-semibold">{{ $site->email }}</dd></div>
                @endif
                @if ($site->hours)
                    <div><dt class="text-text-2">{{ __('Hours') }}</dt><dd class="mt-1 font-semibold">{{ $site->hours }}</dd></div>
                @endif
            </dl>
        </x-card>

        <form method="POST" action="{{ route('contact.store') }}" class="lg:col-span-3">
            @csrf
            <div class="honeypot" aria-hidden="true">
                <label>{{ __('Website') }} <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            </div>
            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Enquiry') }}</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <x-field :label="__('Name')" name="name"><input name="name" value="{{ old('name') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Email')" name="email"><input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Mobile')" name="mobile"><input name="mobile" value="{{ old('mobile') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Subject')" name="subject"><input name="subject" value="{{ old('subject') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <div class="md:col-span-2"><x-field :label="__('Message')" name="message"><textarea name="message" rows="5" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">{{ old('message') }}</textarea></x-field></div>
                </div>
                <label class="mt-6 flex items-start gap-3 text-sm text-text-2">
                    <input type="checkbox" name="consent" value="1" class="mt-1 rounded border-border" @checked(old('consent'))>
                    <span>{{ $site->consent_text }}</span>
                </label>
                @error('consent')
                    <p class="mt-2 text-sm text-danger">{{ __('I agree to be contacted about this submission. I understand that sending this form does not guarantee a loan, interest rate, or approval.') }}</p>
                @enderror
                <div class="mt-6">
                    <x-button type="submit">{{ __('Send enquiry') }}</x-button>
                </div>
            </x-card>
        </form>
    </section>
</x-public-layout>
