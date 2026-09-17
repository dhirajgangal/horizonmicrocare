<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="$userId ? __('Edit') : __('Add user')" />
            <x-button variant="secondary" :href="route('admin.users.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Name')" name="name"><input wire:model="name" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Email')" name="email"><input type="email" wire:model="email" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Password')" name="password" :hint="$userId ? __('Leave blank to keep the current password.') : null">
                    <input type="password" wire:model="password" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                </x-field>
            </div>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ $userId ? __('Update') : __('Save') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.users.index')" />
        </div>
    </form>
</div>
