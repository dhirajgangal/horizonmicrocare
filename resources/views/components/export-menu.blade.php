@props(['module', 'search' => '', 'sortField' => 'id', 'sortDirection' => 'desc', 'status' => ''])

@php
    $params = array_filter([
        'search' => $search,
        'sortField' => $sortField,
        'sortDirection' => $sortDirection,
        'status' => $status,
    ], fn ($value) => $value !== null && $value !== '');
@endphp

<div class="relative" x-data="{ open: false }">
    <x-icon-button icon="arrow-down-tray" :tooltip="__('Export')" @click="open = ! open" />
    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        class="absolute right-0 z-30 mt-2 w-40 overflow-hidden rounded-xl border border-border bg-surface shadow-lg"
    >
        @foreach (['csv' => 'CSV', 'xlsx' => 'Excel', 'pdf' => 'PDF'] as $format => $label)
            <a
                href="{{ route('admin.export', array_merge($params, ['module' => $module, 'format' => $format])) }}"
                class="flex items-center gap-2 px-3 py-2.5 text-sm font-semibold text-navy hover:bg-paper"
            >
                <x-ui-icon name="document-arrow-down" class="h-4 w-4 text-orange" />
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>
