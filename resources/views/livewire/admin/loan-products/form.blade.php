<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="$productId ? __('Edit') : __('Add product')" />
            <x-button variant="secondary" :href="route('admin.loan-products.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Name')" name="name"><input wire:model="name" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Slug')" name="slug" :hint="__('Leave blank to generate from the name.')"><input wire:model="slug" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <div class="md:col-span-2"><x-field :label="__('Short description')" name="short_description"><input wire:model="short_description" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field></div>
                <div class="md:col-span-2"><x-field :label="__('Full description')" name="description"><textarea wire:model="description" rows="5" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
                <div class="md:col-span-2"><x-field :label="__('Features (one per line)')" name="featuresText"><textarea wire:model="featuresText" rows="4" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
                <x-field :label="__('Eligibility notes')" name="eligibility"><textarea wire:model="eligibility" rows="4" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field>
                <x-field :label="__('Required documents')" name="required_documents"><textarea wire:model="required_documents" rows="4" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field>
            </div>
        </x-card>
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label class="inline-flex items-center gap-2 text-sm font-semibold"><input type="checkbox" wire:model="is_active" class="rounded border-border"> {{ __('Active') }}</label>
                <x-field :label="__('Sort order')" name="sort_order"><input type="number" wire:model="sort_order" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ $productId ? __('Update') : __('Save') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.loan-products.index')" />
        </div>
    </form>
</div>
