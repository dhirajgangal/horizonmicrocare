<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Loan products')" description="Only active products appear on the public site." />
        <div class="flex items-center gap-2">
            <x-export-menu module="loan-products" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" />
            <x-button wire:click="openCreate">{{ __('Add product') }}</x-button>
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
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('name')">{{ __('Name') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('sort_order')">{{ __('Order') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('is_active')">{{ __('Status') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($products as $product)
                        <tr wire:key="product-{{ $product->id }}">
                            <td class="px-4 py-3 font-semibold">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-text-2">{{ $product->sort_order }}</td>
                            <td class="px-4 py-3"><x-status-badge :tone="$product->is_active ? 'success' : 'muted'" :label="$product->is_active ? __('Active') : __('Hidden')" /></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $product->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $product->id }})" />
                                    <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $product->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-12 text-center text-text-2">{{ __('No products yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $products->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if (in_array($modal, ['create', 'edit'], true) && ($modal !== 'edit' || $modalRecord))
        <x-admin-modal :title="$modal === 'edit' ? __('Edit') : __('Add product')" :open="true" size="xl">
            <livewire:admin.loan-products.form :loan-product="$modalRecord" :embedded="true" :key="'product-form-'.($modalId ?? 'new')" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true" size="xl">
            <livewire:admin.loan-products.show :loan-product="$modalRecord" :embedded="true" :key="'product-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
