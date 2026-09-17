<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="$faqId ? __('Edit') : __('Add FAQ')" />
            <x-button variant="secondary" :href="route('admin.faqs.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
            <div class="grid gap-4">
                <x-field label="Question" name="question"><input wire:model="question" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                <x-field label="Answer" name="answer"><textarea wire:model="answer" rows="5" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field>
                <x-field label="Category" name="category"><input wire:model="category" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
            <div class="flex flex-wrap gap-6">
                <label class="inline-flex items-center gap-2 text-sm font-semibold"><input type="checkbox" wire:model="is_active" class="rounded border-border"> Active</label>
                <label class="inline-flex items-center gap-2 text-sm font-semibold"><input type="checkbox" wire:model="is_featured" class="rounded border-border"> Featured on home</label>
                <x-field label="Sort order" name="sort_order"><input type="number" wire:model="sort_order" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
            </div>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ $faqId ? __('Update') : __('Save') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.faqs.index')" />
        </div>
    </form>
</div>
