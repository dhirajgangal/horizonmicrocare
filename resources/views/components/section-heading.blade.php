@props(['eyebrow' => null, 'title', 'description' => null])

<div {{ $attributes->merge(['class' => 'max-w-3xl']) }}>
    @if ($eyebrow)
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange">{{ $eyebrow }}</p>
    @endif
    <h2 class="mt-2 font-serif text-3xl text-navy md:text-4xl">{{ $title }}</h2>
    @if ($description)
        <p class="mt-3 text-base leading-relaxed text-text-2">{{ $description }}</p>
    @endif
</div>
