@props(['type' => 'success'])

@php
    $classes = $type === 'danger'
        ? 'toast-card is-danger border border-border px-4 py-3 text-sm text-navy'
        : 'toast-card is-success border border-border px-4 py-3 text-sm text-navy';
@endphp

<div {{ $attributes->merge(['class' => $classes, 'role' => 'status']) }}>
    {{ $slot }}
</div>
