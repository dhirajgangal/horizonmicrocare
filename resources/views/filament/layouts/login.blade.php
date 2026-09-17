@php
    use Filament\Support\Enums\Width;
    use Filament\Support\Facades\FilamentView;
    use Filament\View\PanelsRenderHook;

    $settings = app(\App\Services\SiteSettings::class);
    $livewire ??= null;
    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Large);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="admin-login">
        <section class="admin-login__visual">
            <img src="{{ $settings->logoUrl('rectangle') }}" alt="{{ $settings->get('general.company_name') }}">
            <p class="admin-login__kicker">Women. Livelihoods. Community.</p>
            <h1>Empowering Women. Building Stronger Communities.</h1>
            <p>
                A trusted workspace for managing public content, loan information, and customer enquiries.
                This portal does not approve loans by itself.
            </p>
        </section>

        <section class="admin-login__form">
            <div class="fi-simple-layout">
                {{ FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

                <div class="fi-simple-main-ctn">
                    <main
                        id="fi-main-content"
                        tabindex="-1"
                        @class([
                            'fi-simple-main',
                            ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                        ])
                    >
                        {{ $slot }}
                    </main>
                </div>

                {{ FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
            </div>
        </section>
    </div>
</x-filament-panels::layout.base>
