<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Home slides')" description="Active slides appear on the public homepage carousel." />
        <div class="flex items-center gap-2">
            <x-export-menu module="home-slides" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" />
            <x-button wire:click="openCreate">{{ __('Add slide') }}</x-button>
        </div>
    </div>
    <x-card :padding="false">
        <div class="flex flex-wrap items-center gap-3 border-b border-border p-4">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}" class="w-full max-w-sm rounded-btn border border-border px-3 py-2.5 text-sm">
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-text-2">
                    <tr>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('heading')">{{ __('Heading') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('sort_order')">{{ __('Order') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('is_active')">{{ __('Status') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($slides as $slide)
                        <tr wire:key="slide-{{ $slide->id }}">
                            <td class="px-4 py-3 font-semibold text-navy">{{ $slide->heading }}</td>
                            <td class="px-4 py-3 text-text-2">{{ $slide->sort_order }}</td>
                            <td class="px-4 py-3"><x-status-badge :tone="$slide->is_active ? 'success' : 'muted'" :label="$slide->is_active ? __('Active') : __('Hidden')" /></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $slide->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $slide->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $slide->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-12 text-center text-text-2">{{ __('No slides yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $slides->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if (in_array($modal, ['create', 'edit'], true) && ($modal !== 'edit' || $modalRecord))
        <x-admin-modal :title="$modal === 'edit' ? __('Edit') : __('Add slide')" :open="true" size="xl">
            <livewire:admin.home-slides.form :home-slide="$modalRecord" :embedded="true" :key="'slide-form-'.($modalId ?? 'new')" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="xl">
            <livewire:admin.home-slides.show :home-slide="$modalRecord" :embedded="true" :key="'slide-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
