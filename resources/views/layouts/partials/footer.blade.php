<footer class="mt-16 border-t border-border bg-primary text-white">
    <div class="container-site grid gap-10 py-12 md:grid-cols-2 xl:grid-cols-6">
        <div class="xl:col-span-2">
            <a href="{{ route('home') }}" class="inline-flex items-center">
                <img
                    src="{{ $site->logoUrl('rectangle') }}"
                    alt="{{ $site->get('general.company_name') }}"
                    class="h-12 w-auto rounded-sm bg-white p-1"
                >
            </a>
            <p class="mt-4 max-w-sm text-sm leading-6 text-white/80">
                {{ $site->get('general.short_description') }}
            </p>
            <p class="mt-3 text-sm font-medium text-accent">{{ $site->get('general.tagline') }}</p>
            <div class="mt-5 flex flex-wrap gap-3 text-sm">
                @foreach (['facebook', 'instagram', 'linkedin', 'twitter', 'youtube'] as $network)
                    @if ($site->get('social.'.$network))
                        <a href="{{ $site->get('social.'.$network) }}" class="underline-offset-2 hover:text-accent hover:underline" rel="noopener noreferrer" target="_blank">
                            {{ ucfirst($network) }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        @foreach ($footerColumns as $column)
            <div>
                <h2 class="font-sans text-sm font-semibold tracking-wide uppercase">{{ $column['title'] }}</h2>
                <ul class="mt-4 space-y-2 text-sm text-white/80">
                    @foreach ($column['links'] as $link)
                        <li>
                            <a href="{{ route($link['route']) }}" class="hover:text-accent">{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <div class="border-t border-white/10">
        <div class="container-site flex flex-col gap-3 py-5 text-xs text-white/70 md:flex-row md:items-center md:justify-between">
            <p>{{ $site->get('footer.copyright') }}</p>
            <p class="max-w-2xl md:text-right">{{ $site->get('footer.legal_text') }}</p>
        </div>
    </div>
</footer>
