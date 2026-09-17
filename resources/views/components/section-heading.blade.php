@props([
    'eyebrow' => null,
    'heading',
    'intro' => null,
])

<div {{ $attributes->merge(['class' => 'max-w-3xl']) }}>
    @if ($eyebrow)
        <p class="text-sm font-semibold tracking-[0.16em] text-accent uppercase">{{ $eyebrow }}</p>
    @endif
    <h2 class="mt-2 text-3xl text-primary md:text-4xl">{{ $heading }}</h2>
    @if ($intro)
        <p class="mt-4 text-base leading-7 text-text-secondary">{{ $intro }}</p>
    @endif
</div>
