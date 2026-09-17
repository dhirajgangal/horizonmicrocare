<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ApplicationStatusChart;
use App\Filament\Widgets\DashboardTables;
use App\Filament\Widgets\DashboardWelcome;
use App\Filament\Widgets\FoundationOverview;
use App\Filament\Widgets\LoanProductDistributionChart;
use App\Filament\Widgets\MonthlyApplicationsChart;
use App\Filament\Widgets\QuickActions;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    public static function canAccess(): bool
    {
        return auth()->user()?->can('dashboard.view') ?? false;
    }

    /**
     * @return array<class-string>
     */
    public function getWidgets(): array
    {
        return [
            DashboardWelcome::class,
            FoundationOverview::class,
            ApplicationStatusChart::class,
            LoanProductDistributionChart::class,
            MonthlyApplicationsChart::class,
            DashboardTables::class,
            QuickActions::class,
        ];
    }

    /**
     * @return int|array<string, int|null>
     */
    public function getColumns(): int|array
    {
        return [
            'md' => 2,
            'xl' => 2,
        ];
    }
}
