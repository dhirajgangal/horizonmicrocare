@if (! empty($crumbs))
    <nav aria-label="Breadcrumb" class="container-site pt-6">
        <ol class="flex flex-wrap items-center gap-2 text-sm text-text-secondary">
            <li>
                <a href="{{ route('home') }}" class="hover:text-accent">Home</a>
            </li>
            @foreach ($crumbs as $label => $url)
                <li aria-hidden="true">/</li>
                <li>
                    @if ($url)
                        <a href="{{ $url }}" class="hover:text-accent">{{ $label }}</a>
                    @else
                        <span class="text-primary" aria-current="page">{{ $label }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
