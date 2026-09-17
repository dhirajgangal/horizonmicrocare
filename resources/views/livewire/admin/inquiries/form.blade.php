<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="__('Edit')" />
            <x-button variant="secondary" :href="route('admin.inquiries.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
            <x-field :label="__('Status')" name="status">
                <select wire:model="status" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                    @foreach (\App\Enums\InquiryStatus::cases() as $statusOption)
                        <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
                    @endforeach
                </select>
            </x-field>
            <div class="mt-4">
                <x-field :label="__('Notes')" name="notes"><textarea wire:model="notes" rows="5" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea></x-field>
            </div>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ __('Update') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.inquiries.index')" />
        </div>
    </form>
</div>
