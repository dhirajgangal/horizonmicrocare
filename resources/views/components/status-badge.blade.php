@props(['tone' => 'info', 'label'])

@php
    $classes = match ($tone) {
        'success' => 'bg-orange/10 text-orange',
        'warning' => 'bg-warning/10 text-warning',
        'danger' => 'bg-danger/10 text-danger',
        'muted' => 'bg-border text-text-2',
        default => 'bg-navy/10 text-navy',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex rounded-btn px-2.5 py-1 text-xs font-semibold '.$classes]) }}>
    {{ $label }}
</span>
