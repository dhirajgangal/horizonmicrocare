<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Client stories')" :description="__('Published stories appear on the public website.')" />
        <x-button wire:click="openCreate">{{ __('Add story') }}</x-button>
    </div>
    <x-card :padding="false">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-border p-4">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}" class="w-full max-w-sm rounded-btn border border-border px-3 py-2.5 text-sm">
            <x-export-menu module="client-stories" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" />
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-text-2">
                    <tr>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('name')">{{ __('Name') }}</button></th>
                        <th class="px-4 py-3">{{ __('Location') }}</th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('is_published')">{{ __('Status') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($stories as $story)
                        <tr wire:key="story-{{ $story->id }}">
                            <td class="px-4 py-3 font-semibold">{{ $story->name }}</td>
                            <td class="px-4 py-3 text-text-2">{{ $story->location ?: '—' }}</td>
                            <td class="px-4 py-3"><x-status-badge :tone="$story->is_published ? 'success' : 'muted'" :label="$story->is_published ? __('Published') : __('Draft')" /></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $story->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $story->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $story->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-12 text-center text-text-2">{{ __('No stories yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $stories->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if (in_array($modal, ['create', 'edit'], true) && ($modal !== 'edit' || $modalRecord))
        <x-admin-modal :title="$modal === 'edit' ? __('Edit') : __('Add story')" :open="true" size="xl">
            <livewire:admin.client-stories.form :client-story="$modalRecord" :embedded="true" :key="'story-form-'.($modalId ?? 'new')" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="xl">
            <livewire:admin.client-stories.show :client-story="$modalRecord" :embedded="true" :key="'story-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
