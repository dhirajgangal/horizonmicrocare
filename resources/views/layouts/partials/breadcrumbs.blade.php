<nav class="mx-auto max-w-7xl px-4 py-5 md:px-6" aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2 text-sm text-text-2">
        <li><a href="{{ route('home') }}" class="hover:text-orange">Home</a></li>
        @foreach ($items as $item)
            <li aria-hidden="true">/</li>
            <li>
                @if (! empty($item['url']) && ! $loop->last)
                    <a href="{{ $item['url'] }}" class="hover:text-orange">{{ $item['label'] }}</a>
                @else
                    <span class="font-semibold text-navy">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
