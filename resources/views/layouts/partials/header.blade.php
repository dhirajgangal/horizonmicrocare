<header
    x-data="{ open: false }"
    class="sticky top-0 z-40 border-b border-border/80 bg-surface/95 backdrop-blur"
>
    <div class="container-site flex items-center justify-between gap-4 py-3">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3" aria-label="{{ $site->get('general.company_name') }} home">
            <img
                src="{{ $site->logoUrl('square') }}"
                alt="{{ $site->get('general.company_name') }}"
                class="h-10 w-10 lg:hidden"
            >
            <img
                src="{{ $site->logoUrl('rectangle') }}"
                alt="{{ $site->get('general.company_name') }}"
                class="hidden h-10 w-auto lg:block"
            >
        </a>

        <nav class="hidden items-center gap-3 xl:flex" aria-label="Primary">
            @foreach ($primaryNavigation as $item)
                <a
                    href="{{ route($item['route']) }}"
                    @class([
                        'whitespace-nowrap text-sm font-medium transition-colors hover:text-accent',
                        'text-accent' => request()->routeIs($item['route']),
                        'text-primary' => ! request()->routeIs($item['route']),
                    ])
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex shrink-0 items-center gap-2">
            @if ($site->get('contact.phone'))
                <a href="tel:{{ $site->get('contact.phone') }}" class="hidden text-sm font-medium text-primary hover:text-accent md:inline">
                    {{ $site->get('contact.phone') }}
                </a>
            @endif

            <x-button href="{{ route('apply') }}" size="sm">
                Apply for Loan
            </x-button>

            <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-border text-primary lg:hidden"
                @click="open = ! open"
                :aria-expanded="open.toString()"
                aria-controls="mobile-navigation"
            >
                <span class="sr-only">Toggle menu</span>
                <svg x-show="!open" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg x-cloak x-show="open" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>
    </div>

    <div
        id="mobile-navigation"
        x-cloak
        x-show="open"
        x-transition
        class="border-t border-border bg-surface lg:hidden"
    >
        <nav class="container-site flex flex-col gap-1 py-4" aria-label="Mobile">
            @foreach ($primaryNavigation as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="rounded-md px-3 py-3 text-base font-medium text-primary hover:bg-background"
                    @click="open = false"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
            <x-button href="{{ route('apply') }}" class="mt-2 w-full justify-center">
                Apply for Loan
            </x-button>
        </nav>
    </div>
</header>
