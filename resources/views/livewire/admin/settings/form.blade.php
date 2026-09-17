<div class="space-y-6">
    <x-section-heading :title="__('Settings')" :description="__('Organisation, contact, SEO, consent, and CEO content used across the public site.')" />

    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Organisation name')" name="organization_name"><input wire:model="organization_name" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Tagline')" name="tagline"><input wire:model="tagline" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Phone')" name="phone"><input wire:model="phone" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Email')" name="email"><input wire:model="email" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Hours')" name="hours"><input wire:model="hours" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Admin notification email')" name="admin_notification_email"><input wire:model="admin_notification_email" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <div class="md:col-span-2"><x-field :label="__('Address')" name="address"><textarea wire:model="address" rows="3" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
            </div>
        </x-card>

        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Social & SEO') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Facebook')" name="facebook_url"><input wire:model="facebook_url" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Instagram')" name="instagram_url"><input wire:model="instagram_url" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('X / Twitter')" name="twitter_url"><input wire:model="twitter_url" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('YouTube')" name="youtube_url"><input wire:model="youtube_url" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('LinkedIn')" name="linkedin_url"><input wire:model="linkedin_url" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('SEO title')" name="seo_title"><input wire:model="seo_title" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <div class="md:col-span-2"><x-field :label="__('SEO description')" name="seo_description"><textarea wire:model="seo_description" rows="3" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
                <div class="md:col-span-2"><x-field :label="__('Consent text')" name="consent_text"><textarea wire:model="consent_text" rows="3" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
            </div>
        </x-card>

        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('CEO') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Name')" name="ceo_name"><input wire:model="ceo_name" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Designation')" name="ceo_designation"><input wire:model="ceo_designation" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <div class="md:col-span-2"><x-field :label="__('Story / bio')" name="ceo_bio"><textarea wire:model="ceo_bio" rows="6" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
                <x-field :label="__('Photo')" name="ceo_photo"><input type="file" wire:model="ceo_photo" accept="image/*" class="block w-full text-sm"></x-field>
            </div>
            @if ($existingCeoPhoto)
                <img src="{{ asset('storage/'.$existingCeoPhoto) }}" alt="" class="mt-4 h-32 rounded-btn object-cover">
            @endif
        </x-card>

        <x-button type="submit">{{ __('Update') }}</x-button>
    </form>
</div>
