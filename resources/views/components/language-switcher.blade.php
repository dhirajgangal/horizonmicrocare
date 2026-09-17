@props(['tone' => 'light'])

@php
    $current = app()->getLocale();
    $button = $tone === 'dark'
        ? 'rounded-btn px-2 py-1 text-xs font-semibold'
        : 'rounded-btn px-2 py-1 text-xs font-semibold';
@endphp

<div class="inline-flex items-center gap-1 rounded-btn border border-border bg-white p-1" role="group" aria-label="{{ __('Language') }}">
    @foreach (config('app.available_locales', ['gu', 'en']) as $locale)
        <a
            href="{{ route('locale.switch', $locale) }}"
            @class([
                $button,
                'bg-navy text-white' => $current === $locale && $tone === 'light',
                'bg-orange text-white' => $current === $locale && $tone === 'dark',
                'text-navy hover:bg-paper' => $current !== $locale && $tone === 'light',
                'text-white/80 hover:bg-white/10' => $current !== $locale && $tone === 'dark',
            ])
        >{{ strtoupper($locale) }}</a>
    @endforeach
</div>
