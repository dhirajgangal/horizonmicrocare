@props([
    'title',
    'size' => 'lg',
    'open' => false,
])

@php
    $maxWidth = match ($size) {
        'md' => 'max-w-xl',
        'xl' => 'max-w-5xl',
        default => 'max-w-3xl',
    };
@endphp

<div
    x-data="{ open: @js($open) }"
    x-init="$watch('open', value => { if (! value) $wire.closeModal() })"
    x-show="open"
    x-cloak
    class="confirm-overlay fixed inset-0 z-50 flex items-start justify-center overflow-y-auto px-4 py-8"
    @keydown.escape.window="open = false"
>
    <div class="absolute inset-0" @click="open = false"></div>
    <div
        class="relative my-auto w-full {{ $maxWidth }} rounded-xl border border-border bg-surface shadow-xl"
        role="dialog"
        aria-modal="true"
        aria-label="{{ $title }}"
    >
        <div class="flex items-center justify-between border-b border-border px-6 py-4">
            <h2 class="font-serif text-xl text-navy">{{ $title }}</h2>
            <x-icon-button icon="x-mark" :tooltip="__('Close')" @click="open = false" />
        </div>
        <div class="max-h-[75vh] overflow-y-auto px-6 py-5">
            {{ $slot }}
        </div>
    </div>
</div>
