<div class="space-y-6">
    @unless ($embedded)
        <div class="flex items-center justify-between">
            <x-section-heading :title="__('Edit')" description="Internal review only. This website does not grant loans." />
            <x-button variant="secondary" :href="route('admin.loan-applications.index')">{{ __('Cancel') }}</x-button>
        </div>
    @endunless
    <form wire:submit="save" class="space-y-6">
        <x-card>
            <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
            <x-field label="Internal status" name="status">
                <select wire:model="status" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                    @foreach (\App\Enums\ApplicationStatus::cases() as $statusOption)
                        <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
                    @endforeach
                </select>
            </x-field>
            <div class="mt-4">
                <x-field label="Internal notes" name="internal_notes">
                    <textarea wire:model="internal_notes" rows="5" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></textarea>
                </x-field>
            </div>
        </x-card>
        <div class="flex gap-3">
            <x-button type="submit">{{ __('Update') }}</x-button>
            <x-admin-cancel :embedded="$embedded" :href="route('admin.loan-applications.index')" />
        </div>
    </form>
</div>
