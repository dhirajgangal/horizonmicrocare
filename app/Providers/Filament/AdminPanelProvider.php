<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Widgets\ApplicationStatusChart;
use App\Filament\Widgets\DashboardTables;
use App\Filament\Widgets\DashboardWelcome;
use App\Filament\Widgets\FoundationOverview;
use App\Filament\Widgets\LoanProductDistributionChart;
use App\Filament\Widgets\MonthlyApplicationsChart;
use App\Filament\Widgets\QuickActions;
use App\Services\SiteSettings;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->passwordReset()
            ->profile()
            ->darkMode(false)
            ->brandName(fn (): string => app(SiteSettings::class)->get('general.company_name'))
            ->brandLogo(fn (): string => app(SiteSettings::class)->logoUrl('rectangle'))
            ->brandLogoHeight('2rem')
            ->favicon(fn (): string => app(SiteSettings::class)->logoUrl('square'))
            ->colors([
                'primary' => Color::hex((string) config('brand.accent')),
                'danger' => Color::hex((string) config('brand.danger')),
                'warning' => Color::hex((string) config('brand.warning')),
                'success' => Color::hex((string) config('brand.success')),
                'info' => Color::hex((string) config('brand.primary')),
            ])
            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('4.5rem')
            ->maxContentWidth(Width::Full)
            ->navigationGroups([
                NavigationGroup::make('Loan Management')->collapsed(false),
                NavigationGroup::make('Website Content')->collapsed(false),
                NavigationGroup::make('Customer Management'),
                NavigationGroup::make('Website Settings'),
                NavigationGroup::make('Administration'),
            ])
            ->userMenuItems([
                'profile' => fn (Action $action): Action => $action->label('My Profile'),
                'logout' => fn (Action $action): Action => $action
                    ->label('Logout')
                    ->requiresConfirmation()
                    ->modalHeading('Logout?')
                    ->modalDescription('Are you sure you want to logout?')
                    ->modalSubmitActionLabel('Logout'),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('<link rel="stylesheet" href="{{ asset(\'css/admin-theme.css\') }}">'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                DashboardWelcome::class,
                FoundationOverview::class,
                ApplicationStatusChart::class,
                MonthlyApplicationsChart::class,
                LoanProductDistributionChart::class,
                DashboardTables::class,
                QuickActions::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
