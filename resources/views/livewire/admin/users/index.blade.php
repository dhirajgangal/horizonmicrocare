<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <x-section-heading :title="__('Admin users')" :description="__('Super Admin accounts that can sign in to this panel.')" />
        <x-button wire:click="openCreate">{{ __('Add user') }}</x-button>
    </div>
    <x-card :padding="false">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-border p-4">
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="{{ __('Search') }}" class="w-full max-w-sm rounded-btn border border-border px-3 py-2.5 text-sm">
            <x-export-menu module="users" :search="$search" :sort-field="$sortField" :sort-direction="$sortDirection" />
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-paper text-text-2">
                    <tr>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('name')">{{ __('Name') }}</button></th>
                        <th class="px-4 py-3"><button type="button" wire:click="sortBy('email')">{{ __('Email') }}</button></th>
                        <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($users as $user)
                        <tr wire:key="user-{{ $user->id }}">
                            <td class="px-4 py-3 font-semibold">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-text-2">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <x-icon-button icon="eye" :tooltip="__('View')" wire:click="openView({{ $user->id }})" />
                                    <x-icon-button icon="pencil-square" :tooltip="__('Edit')" wire:click="openEdit({{ $user->id }})" />
                                    @if (! $user->is(auth()->user()))
                                        <x-icon-button icon="trash" variant="danger" :tooltip="__('Delete')" wire:click="confirmDelete({{ $user->id }})" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-12 text-center text-text-2">{{ __('No users yet.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-border px-4 py-3">{{ $users->links() }}</div>
    </x-card>
    <x-confirm-modal wire:model.live="confirmingDeletion" :title="__('Delete')" />

    @if (in_array($modal, ['create', 'edit'], true) && ($modal !== 'edit' || $modalRecord))
        <x-admin-modal :title="$modal === 'edit' ? __('Edit') : __('Add user')" :open="true">
            <livewire:admin.users.form :user="$modalRecord" :embedded="true" :key="'user-form-'.($modalId ?? 'new')" />
        </x-admin-modal>
    @elseif ($modal === 'view' && $modalRecord)
        <x-admin-modal :title="__('View')" :open="true">
            <livewire:admin.users.show :user="$modalRecord" :embedded="true" :key="'user-view-'.$modalId" />
        </x-admin-modal>
    @endif
</div>
