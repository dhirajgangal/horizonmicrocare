<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Loan applications')" description="These are information requests. Status changes here do not mean a loan has been granted by this website." />
        <x-export-menu module="loan-applications" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" :status="$status" />
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
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('full_name')">{{ __('Applicant') }}</button></th>
                        <th class="px-4 py-3">{{ __('Product') }}</th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('status')">{{ __('Status') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('created_at')">{{ __('Received') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($applications as $application)
                        <tr wire:key="application-{{ $application->id }}">
                            <td class="px-4 py-3">
                                <p class="font-semibold">{{ $application->full_name }}</p>
                                <p class="text-xs text-text-2">{{ $application->email }}</p>
                            </td>
                            <td class="px-4 py-3 text-text-2">{{ $application->loanProduct?->name ?? '—' }}</td>
                            <td class="px-4 py-3"><x-status-badge :tone="$application->status->tone()" :label="$application->status->label()" /></td>
                            <td class="px-4 py-3 text-text-2">{{ $application->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $application->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $application->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Archive')" wire:click="confirmDelete({{ $application->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-12 text-center text-text-2">{{ __('No applications yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $applications->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Archive')" body="The record will be archived and hidden from this list." :confirm-text="__('Archive')" />

    @if ($modal === 'edit' && $modalRecord)
        <x-admin-modal :title="__('Edit')" :open="true" size="xl">
            <livewire:admin.loan-applications.form :loan-application="$modalRecord" :embedded="true" :key="'application-form-'.$modalId" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="xl">
            <livewire:admin.loan-applications.show :loan-application="$modalRecord" :embedded="true" :key="'application-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
