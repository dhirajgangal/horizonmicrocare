@props([
    'direction' => 'prev',
])

@php
    $isPrev = $direction === 'prev';
    $label = $isPrev ? __('Previous') : __('Next');
    $icon = $isPrev ? 'chevron-left' : 'chevron-right';
@endphp

<div
    @class([
        'slider-arrow',
        'slider-arrow-prev' => $isPrev,
        'slider-arrow-next' => ! $isPrev,
    ])
    x-data="{ show: false }"
    x-on:mouseenter="show = true"
    x-on:mouseleave="show = false"
    x-on:focusin="show = true"
    x-on:focusout="show = false"
>
    <button
        type="button"
        {{ $attributes->merge([
            'class' => 'slider-arrow-btn rounded-full border border-white/30 bg-navy/80 text-white shadow-lg backdrop-blur transition hover:bg-orange',
            'aria-label' => $label,
        ]) }}
    >
        <x-ui-icon :name="$icon" class="h-6 w-6" />
    </button>
    <div
        x-show="show"
        x-cloak
        x-transition.opacity
        class="pointer-events-none absolute bottom-full left-1/2 mb-2 -translate-x-1/2 whitespace-nowrap rounded-btn bg-navy px-2.5 py-1 text-xs font-semibold text-white shadow-lg"
        role="tooltip"
    >
        {{ $label }}
    </div>
</div>
