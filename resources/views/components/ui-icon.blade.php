@props(['name', 'variant' => 'outline'])

@php
    $component = $variant === 'solid' ? 'heroicon-s-'.$name : 'heroicon-o-'.$name;
@endphp

<x-dynamic-component :component="$component" {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
