<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="$storyId ? __('Edit') : __('Add story')" />
            <x-button variant="secondary" :href="route('admin.client-stories.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field :label="__('Name')" name="name"><input wire:model="name" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Location')" name="location"><input wire:model="location" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <div class="md:col-span-2"><x-field :label="__('Feedback')" name="feedback"><textarea wire:model="feedback" rows="5" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field></div>
                <x-field :label="__('Slug')" name="slug"><input wire:model="slug" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field :label="__('Sort order')" name="sort_order"><input type="number" wire:model="sort_order" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Media') }}</h3>
            <x-field :label="__('Photo')" name="photo"><input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm"></x-field>
            @if ($existingPhoto)
                <img src="{{ asset('storage/'.$existingPhoto) }}" alt="" class="mt-4 h-32 rounded-btn object-cover">
            @endif
        </x-card>
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
            <label class="inline-flex items-center gap-2 text-sm font-semibold"><input type="checkbox" wire:model="is_published" class="rounded border-border"> {{ __('Published') }}</label>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ $storyId ? __('Update') : __('Save') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.client-stories.index')" />
        </div>
    </form>
</div>
