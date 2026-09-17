@props([
    'label' => null,
    'name' => null,
    'hint' => null,
])

<label class="block">
    @if ($label)
        <span class="mb-1.5 block text-sm font-semibold text-navy">{{ $label }}</span>
    @endif

    {{ $slot }}

    @if ($hint)
        <span class="mt-1 block text-xs text-text-2">{{ $hint }}</span>
    @endif

    @if ($name)
        @error($name)
            <span class="mt-1 block text-sm text-danger">{{ $message }}</span>
        @enderror
    @endif
</label>
