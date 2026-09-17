@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $classes = match ($variant) {
        'secondary' => 'theme-btn theme-btn--secondary',
        'secondary-inverse' => 'theme-btn theme-btn--secondary-inverse',
        'ghost' => 'theme-btn theme-btn--ghost',
        default => 'theme-btn theme-btn--primary',
    };

    $sizes = match ($size) {
        'sm' => 'theme-btn--sm',
        'lg' => 'theme-btn--lg',
        default => 'theme-btn--md',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "{$classes} {$sizes}"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "{$classes} {$sizes}"]) }}>
        {{ $slot }}
    </button>
@endif
