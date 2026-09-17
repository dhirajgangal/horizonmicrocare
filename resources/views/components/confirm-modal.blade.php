@props([
    'title' => null,
    'body' => null,
    'confirmText' => null,
    'confirmMethod' => 'deleteConfirmed',
])

@php
    $title = $title ?? __('Delete this record?');
    $body = $body ?? __('This action cannot be undone.');
    $confirmText = $confirmText ?? __('Delete');
@endphp

<div
    x-data="{ open: false }"
    x-modelable="open"
    {{ $attributes }}
    x-cloak
>
    <div
        x-show="open"
        x-transition.opacity
        class="confirm-overlay fixed inset-0 z-50 flex items-center justify-center px-4"
        @keydown.escape.window="open = false"
    >
        <div class="absolute inset-0" @click="open = false"></div>
        <div class="relative w-full max-w-md rounded-xl border border-border bg-surface p-6 shadow-xl" role="dialog" aria-modal="true">
            <h2 class="font-serif text-xl text-navy">{{ $title }}</h2>
            <p class="mt-2 text-sm text-text-2">{{ $body }}</p>
            <div class="mt-6 flex justify-end gap-3">
                <x-button variant="secondary" @click="open = false">{{ __('Cancel') }}</x-button>
                <x-button variant="danger" type="button" wire:click="{{ $confirmMethod }}">{{ $confirmText }}</x-button>
            </div>
        </div>
    </div>
</div>
