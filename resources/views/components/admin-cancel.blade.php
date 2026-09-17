@props([
    'embedded' => false,
    'href' => null,
])

@if ($embedded)
    <x-button variant="secondary" type="button" wire:click="$dispatch('close-modal')">{{ __('Cancel') }}</x-button>
@else
    <x-button variant="secondary" :href="$href">{{ __('Cancel') }}</x-button>
@endif
