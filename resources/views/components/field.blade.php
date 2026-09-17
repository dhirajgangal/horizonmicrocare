@props([
    'label',
    'name',
    'type' => 'text',
    'required' => false,
])

@php
    $hasError = $errors->has($name);
@endphp

<div>
    <label for="{{ $name }}" class="text-sm font-semibold text-primary">
        {{ $label }}
        @if ($required)
            <span class="text-accent" aria-hidden="true">*</span>
        @endif
    </label>

    @if ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            @if ($required) required @endif
            {{ $attributes->merge(['class' => 'mt-1.5 w-full rounded-lg border bg-background px-3.5 py-2.5 text-sm text-primary outline-none transition-colors '.($hasError ? 'border-danger' : 'border-border focus:border-accent')]) }}
        >{{ old($name) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name) }}"
            @if ($required) required @endif
            {{ $attributes->merge(['class' => 'mt-1.5 w-full rounded-lg border bg-background px-3.5 py-2.5 text-sm text-primary outline-none transition-colors '.($hasError ? 'border-danger' : 'border-border focus:border-accent')]) }}
        >
    @endif

    @error($name)
        <p class="mt-1.5 text-sm text-danger">{{ $message }}</p>
    @enderror
</div>
