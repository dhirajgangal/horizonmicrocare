@props([
    'tooltip',
    'icon',
    'href' => null,
    'variant' => 'ghost',
])

@php
    $classes = match ($variant) {
        'danger' => 'icon-btn inline-flex items-center justify-center rounded-btn text-danger transition hover:bg-danger/10',
        'solid' => 'icon-btn inline-flex items-center justify-center rounded-btn bg-orange text-white transition hover:bg-orange-hover',
        'navy' => 'icon-btn inline-flex items-center justify-center rounded-btn border border-navy/15 bg-white text-navy shadow-sm transition hover:border-orange hover:text-orange',
        default => 'icon-btn inline-flex items-center justify-center rounded-btn text-navy transition hover:bg-paper hover:text-orange',
    };
@endphp

<div
    x-data="{ show: false }"
    class="relative inline-flex"
    x-on:mouseenter="show = true"
    x-on:mouseleave="show = false"
    x-on:focusin="show = true"
    x-on:focusout="show = false"
>
    @if ($href)
        <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes, 'aria-label' => $tooltip]) }}>
            <x-ui-icon :name="$icon" />
        </a>
    @else
        <button type="button" {{ $attributes->merge(['class' => $classes, 'aria-label' => $tooltip]) }}>
            <x-ui-icon :name="$icon" />
        </button>
    @endif

    <div
        x-show="show"
        x-cloak
        x-transition.opacity
        class="pointer-events-none absolute bottom-full left-1/2 z-40 mb-2 -translate-x-1/2 whitespace-nowrap rounded-btn bg-navy px-2.5 py-1 text-xs font-semibold text-white shadow-lg"
        role="tooltip"
    >
        {{ $tooltip }}
    </div>
</div>
