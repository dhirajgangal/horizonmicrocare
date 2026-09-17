<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Gallery')" description="Active images appear on the homepage and gallery page." />
        <div class="flex items-center gap-2">
            <x-export-menu module="gallery" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" />
            <x-button wire:click="openCreate">{{ __('Add image') }}</x-button>
        </div>
    </div>
    <x-card :padding="false">
        <div class="border-b border-border p-4">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}" class="w-full max-w-sm rounded-btn border border-border px-3 py-2.5 text-sm">
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-text-2">
                    <tr>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('label')">{{ __('Label') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('is_active')">{{ __('Status') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($images as $image)
                        <tr wire:key="image-{{ $image->id }}">
                            <td class="px-4 py-3 font-semibold">{{ $image->label }}</td>
                            <td class="px-4 py-3"><x-status-badge :tone="$image->is_active ? 'success' : 'muted'" :label="$image->is_active ? __('Active') : __('Hidden')" /></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $image->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $image->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $image->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-12 text-center text-text-2">{{ __('No images yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $images->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if (in_array($modal, ['create', 'edit'], true) && ($modal !== 'edit' || $modalRecord))
        <x-admin-modal :title="$modal === 'edit' ? __('Edit') : __('Add image')" :open="true" size="xl">
            <livewire:admin.gallery-images.form :gallery-image="$modalRecord" :embedded="true" :key="'gallery-form-'.($modalId ?? 'new')" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="xl">
            <livewire:admin.gallery-images.show :gallery-image="$modalRecord" :embedded="true" :key="'gallery-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
