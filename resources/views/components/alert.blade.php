@props([
    'type' => 'info',
])

<div role="status" {{ $attributes->merge(['class' => 'theme-alert theme-alert--'.$type]) }}>
    {{ $slot }}
</div>
