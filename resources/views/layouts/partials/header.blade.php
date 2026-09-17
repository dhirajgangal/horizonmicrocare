@php
    $links = [
        ['route' => 'home', 'label' => __('Home'), 'match' => 'home'],
        ['route' => 'about', 'label' => __('About us'), 'match' => 'about'],
        ['route' => 'mission', 'label' => __('Our mission'), 'match' => 'mission'],
        ['route' => 'offerings.index', 'label' => __('Our offerings'), 'match' => 'offerings.*'],
        ['route' => 'stories.index', 'label' => __('Client stories'), 'match' => 'stories.*'],
        ['route' => 'gallery', 'label' => __('Gallery'), 'match' => 'gallery'],
        ['route' => 'faqs', 'label' => __('FAQs'), 'match' => 'faqs'],
        ['route' => 'contact', 'label' => __('Contact us'), 'match' => 'contact'],
    ];
@endphp

<header
    x-data="{ open: false }"
    class="sticky top-0 z-40 border-b border-border bg-white/95 backdrop-blur"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 md:px-6">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('storage/images/logo-rectangle.png') }}" alt="{{ $site->organization_name }}" class="hidden h-12 w-auto md:block">
            <img src="{{ asset('storage/images/logo-square.png') }}" alt="{{ $site->organization_name }}" class="h-12 w-12 md:hidden">
        </a>

        <nav class="hidden items-center gap-5 xl:flex">
            @foreach ($links as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @class([
                        'text-sm font-semibold transition',
                        'text-orange' => request()->routeIs($link['match']),
                        'text-navy hover:text-orange' => ! request()->routeIs($link['match']),
                    ])
                >{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2 md:gap-3">
            <x-language-switcher />
            <x-button :href="route('apply')">{{ __('Apply for Loan') }}</x-button>
            <x-icon-button
                icon="bars-3"
                :tooltip="__('Menu')"
                variant="navy"
                class="xl:hidden"
                @click="open = ! open"
            />
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-border bg-white px-4 py-4 xl:hidden">
        <div class="flex flex-col gap-3">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}" class="text-sm font-semibold {{ request()->routeIs($link['match']) ? 'text-orange' : 'text-navy' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</header>
