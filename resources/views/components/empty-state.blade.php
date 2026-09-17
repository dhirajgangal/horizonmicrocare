@props([
    'title',
    'actionLabel' => null,
    'actionUrl' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-dashed border-border bg-surface px-6 py-12 text-center']) }}>
    <h2 class="text-2xl text-primary">{{ $title }}</h2>
    <div class="mx-auto mt-3 max-w-xl text-text-secondary">
        {{ $slot }}
    </div>
    @if ($actionLabel && $actionUrl)
        <div class="mt-6">
            <x-button href="{{ $actionUrl }}">{{ $actionLabel }}</x-button>
        </div>
    @endif
</div>
