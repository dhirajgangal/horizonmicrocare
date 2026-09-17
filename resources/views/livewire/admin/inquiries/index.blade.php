<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Inquiries')" description="Contact form submissions from the public website." />
        <x-export-menu module="inquiries" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" :status="$status" />
    </div>
    <x-card :padding="false">
        <div class="flex flex-wrap gap-3 border-b border-border p-4">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}" class="w-full max-w-sm rounded-btn border border-border px-3 py-2.5 text-sm">
            <select wire:model.live="status" class="rounded-btn border border-border px-3 py-2.5 text-sm">
                <option value="">{{ __('All statuses') }}</option>
                @foreach ($statuses as $statusOption)
                    <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-text-2">
                    <tr>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('name')">{{ __('Name') }}</button></th>
                        <th class="px-4 py-3">{{ __('Subject') }}</th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('status')">{{ __('Status') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($inquiries as $inquiry)
                        <tr wire:key="inquiry-{{ $inquiry->id }}">
                            <td class="px-4 py-3 font-semibold">{{ $inquiry->name }}</td>
                            <td class="px-4 py-3 text-text-2">{{ $inquiry->subject }}</td>
                            <td class="px-4 py-3"><x-status-badge :tone="$inquiry->status->tone()" :label="$inquiry->status->label()" /></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $inquiry->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $inquiry->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $inquiry->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-12 text-center text-text-2">{{ __('No inquiries yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $inquiries->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if ($modal === 'edit' && $modalRecord)
        <x-admin-modal :title="__('Edit')" :open="true" size="lg">
            <livewire:admin.inquiries.form :inquiry="$modalRecord" :embedded="true" :key="'inquiry-form-'.$modalId" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="lg">
            <livewire:admin.inquiries.show :inquiry="$modalRecord" :embedded="true" :key="'inquiry-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
