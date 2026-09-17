<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="$imageId ? __('Edit') : __('Add image')" />
            <x-button variant="secondary" :href="route('admin.gallery.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Label')" name="label"><input wire:model="label" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Alt text')" name="alt_text"><input wire:model="alt_text" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Media') }}</h3>
            <x-field :label="__('Image')" name="image"><input type="file" wire:model="image" accept="image/*" class="block w-full text-sm"></x-field>
            @if ($existingImage)
                <img src="{{ asset('storage/'.$existingImage) }}" alt="" class="mt-4 h-32 rounded-btn object-cover">
            @endif
        </x-card>
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label class="inline-flex items-center gap-2 text-sm font-semibold"><input type="checkbox" wire:model="is_active" class="rounded border-border"> {{ __('Active') }}</label>
                <x-field :label="__('Sort order')" name="sort_order"><input type="number" wire:model="sort_order" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ $imageId ? __('Update') : __('Save') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.gallery.index')" />
        </div>
    </form>
</div>
