<div class="mx-auto max-w-2xl space-y-6">
    <x-section-heading :title="__('My profile')" :description="__('Update your name. Change your password only when you need a new one.')" />

    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
            <div class="grid gap-4">
                <x-field :label="__('Name')" name="name">
                    <input wire:model="name" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                </x-field>
                <x-field :label="__('Email')">
                    <input type="email" value="{{ $email }}" readonly class="w-full rounded-btn border border-border bg-paper px-3 py-2.5 text-sm text-text-2">
                </x-field>
            </div>
        </x-card>

        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Password') }}</h3>
            <div class="grid gap-4">
                <x-field :label="__('Current password')" name="current_password">
                    <input type="password" wire:model="current_password" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                </x-field>
                <x-field :label="__('New password')" name="password" :hint="__('Leave blank to keep the current password.')">
                    <input type="password" wire:model="password" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                </x-field>
                <x-field :label="__('Confirm new password')" name="password_confirmation">
                    <input type="password" wire:model="password_confirmation" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                </x-field>
            </div>
        </x-card>

        <x-button type="submit">{{ __('Update') }}</x-button>
    </form>
</div>
