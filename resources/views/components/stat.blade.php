@props([
    'label',
    'value' => '—',
    'prefix' => '',
    'suffix' => '',
])

<x-card {{ $attributes }}>
    <p class="text-sm font-medium text-text-secondary">{{ $label }}</p>
    <p class="mt-2 font-serif text-3xl text-primary">
        {{ $prefix }}{{ $value }}{{ $suffix }}
    </p>
</x-card>
