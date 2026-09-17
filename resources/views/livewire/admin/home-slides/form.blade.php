<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="$slideId ? __('Edit') : __('Add slide')" />
            <x-button variant="secondary" :href="route('admin.home-slides.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless

    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <x-field label="Kicker" name="kicker"><input wire:model="kicker" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field label="Sort order" name="sort_order"><input type="number" wire:model="sort_order" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <div class="md:col-span-2">
                    <x-field label="Heading" name="heading"><input wire:model="heading" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                </div>
                <div class="md:col-span-2">
                    <x-field label="Short text" name="text"><textarea wire:model="text" rows="3" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field>
                </div>
                <x-field label="CTA label" name="cta_label"><input wire:model="cta_label" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field label="CTA URL" name="cta_url"><input wire:model="cta_url" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>

        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">Media</h3>
            <x-field label="Image" name="image">
                <input type="file" wire:model="image" accept="image/*" class="block w-full text-sm">
            </x-field>
            @if ($existingImage)
                <img src="{{ asset('storage/'.$existingImage) }}" alt="" class="mt-4 h-32 rounded-btn object-cover">
            @endif
        </x-card>

        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
            <label class="inline-flex items-center gap-2 text-sm font-semibold">
                <input type="checkbox" wire:model="is_active" class="rounded border-border"> Active
            </label>
        </x-card>

        <div class="flex gap-3">
            <x-button type="submit">{{ $slideId ? __('Update') : __('Save') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.home-slides.index')" />
        </div>
    </form>
</div>
