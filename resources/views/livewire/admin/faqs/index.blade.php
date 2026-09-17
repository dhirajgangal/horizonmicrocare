<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('FAQs')" :description="__('Featured FAQs appear on the homepage.')" />
        <x-button wire:click="openCreate">{{ __('Add FAQ') }}</x-button>
    </div>
    <x-card :padding="false">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-border p-4">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}" class="w-full max-w-sm rounded-btn border border-border px-3 py-2.5 text-sm">
            <x-export-menu module="faqs" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" />
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-text-2">
                    <tr>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('question')">{{ __('Question') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('category')">{{ __('Category') }}</button></th>
                        <th class="px-4 py-3">{{ __('Status') }}</th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($faqs as $faq)
                        <tr wire:key="faq-{{ $faq->id }}">
                            <td class="px-4 py-3 font-semibold">{{ $faq->question }}</td>
                            <td class="px-4 py-3 text-text-2">{{ $faq->category ?: '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <x-status-badge :tone="$faq->is_active ? 'success' : 'muted'" :label="$faq->is_active ? __('Active') : __('Hidden')" />
                                    @if ($faq->is_featured)
                                        <x-status-badge tone="warning" :label="__('Featured')" />
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $faq->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $faq->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $faq->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-12 text-center text-text-2">{{ __('No FAQs yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $faqs->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if (in_array($modal, ['create', 'edit'], true) && ($modal !== 'edit' || $modalRecord))
        <x-admin-modal :title="$modal === 'edit' ? __('Edit') : __('Add FAQ')" :open="true" size="lg">
            <livewire:admin.faqs.form :faq="$modalRecord" :embedded="true" :key="'faq-form-'.($modalId ?? 'new')" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="lg">
            <livewire:admin.faqs.show :faq="$modalRecord" :embedded="true" :key="'faq-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
