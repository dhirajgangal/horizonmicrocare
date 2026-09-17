<footer class="mt-5 bg-navy text-white">
    <div class="public-footer-grid mx-auto max-w-7xl px-4 py-14 md:px-6">
        <div class="min-w-0">
            <a
                href="{{ route('home') }}"
                class="inline-flex max-w-full items-center rounded-btn bg-white px-4 py-3 shadow-sm sm:px-5 sm:py-3.5"
            >
                <img
                    src="{{ asset('storage/images/logo-rectangle.png') }}"
                    alt="{{ $site->organization_name }}"
                    class="h-14 w-auto max-w-full object-contain object-left sm:h-16"
                >
            </a>
            <p class="mt-5 max-w-sm text-sm leading-relaxed text-white/75">
                {{ __('Horizonion Microcare Association helps women explore livelihood and self-empowerment loan options. Submitting a form never guarantees a loan, rate, or approval.') }}
            </p>
            <p class="mt-3 text-sm font-semibold text-orange">{{ $site->tagline }}</p>
        </div>

        <div class="min-w-0">
            <h3 class="eyebrow text-sm">{{ __('Offerings') }}</h3>
            <ul class="mt-4 space-y-2 text-sm text-white/80">
                <li><a class="hover:text-white" href="{{ route('offerings.index') }}">{{ __('Our offerings') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('apply') }}">{{ __('Apply for a loan') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('stories.index') }}">{{ __('Client stories') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('gallery') }}">{{ __('Gallery') }}</a></li>
            </ul>
        </div>

        <div class="min-w-0">
            <h3 class="eyebrow text-sm">{{ __('Support') }}</h3>
            <ul class="mt-4 space-y-2 text-sm text-white/80">
                <li><a class="hover:text-white" href="{{ route('faqs') }}">{{ __('FAQs') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('contact') }}">{{ __('Contact us') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('responsible-lending') }}">{{ __('Responsible lending') }}</a></li>
                @if ($site->phone)
                    <li>{{ $site->phone }}</li>
                @endif
                @if ($site->email)
                    <li>{{ $site->email }}</li>
                @endif
            </ul>
        </div>

        <div class="min-w-0">
            <h3 class="eyebrow text-sm">{{ __('Legal') }}</h3>
            <ul class="mt-4 space-y-2 text-sm text-white/80">
                <li><a class="hover:text-white" href="{{ route('privacy') }}">{{ __('Privacy policy') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('terms') }}">{{ __('Terms') }}</a></li>
                <li><a class="hover:text-white" href="{{ route('disclaimer') }}">{{ __('Disclaimer') }}</a></li>
            </ul>
            @if (count($site->socialLinks()))
                <div class="mt-5 flex flex-wrap gap-3 text-sm">
                    @foreach ($site->socialLinks() as $label => $url)
                        <a href="{{ $url }}" class="text-white/80 hover:text-orange" target="_blank" rel="noreferrer">{{ $label }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="border-t border-white/10 py-4 text-center text-xs text-white/60">
        © {{ date('Y') }} {{ $site->organization_name }}. Information only — not a loan offer.
    </div>
</footer>
