@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $classes = match ($variant) {
        'secondary' => 'inline-flex items-center justify-center rounded-btn border border-navy bg-transparent px-5 py-2.5 text-sm font-semibold text-navy transition hover:bg-navy hover:text-white',
        'danger' => 'inline-flex items-center justify-center rounded-btn bg-danger px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-800',
        'ghost' => 'inline-flex items-center justify-center rounded-btn px-3 py-2 text-sm font-semibold text-navy transition hover:bg-paper',
        default => 'inline-flex items-center justify-center rounded-btn bg-orange px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-hover',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
