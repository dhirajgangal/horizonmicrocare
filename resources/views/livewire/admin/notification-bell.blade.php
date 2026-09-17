<div class="relative" x-data="{ open: false }">
    <x-icon-button icon="bell" :tooltip="__('Notifications')" @click="open = ! open" />
    @if ($unread->isNotEmpty())
        <span class="pointer-events-none absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-orange px-1 text-[11px] text-white">{{ $unread->count() }}</span>
    @endif
    <div x-show="open" x-cloak @click.outside="open = false" class="absolute right-0 z-30 mt-2 w-80 rounded-xl border border-border bg-white shadow-lg">
        <div class="flex items-center justify-between border-b border-border px-4 py-3">
            <p class="text-sm font-semibold text-navy">{{ __('Notifications') }}</p>
            @if ($unread->isNotEmpty())
                <button type="button" class="text-xs font-semibold text-orange" wire:click="markAllRead">{{ __('Mark all read') }}</button>
            @endif
        </div>
        <div class="max-h-80 overflow-y-auto">
            @forelse ($unread as $notification)
                <button type="button" class="block w-full px-4 py-3 text-left hover:bg-paper" wire:click="markRead('{{ $notification->id }}')">
                    <p class="text-sm font-semibold text-navy">{{ $notification->data['title'] ?? 'Update' }}</p>
                    <p class="mt-1 text-xs text-text-2">{{ $notification->data['message'] ?? '' }}</p>
                </button>
            @empty
                <p class="px-4 py-8 text-center text-sm text-text-2">{{ __('No unread alerts.') }}</p>
            @endforelse
        </div>
    </div>
</div>
