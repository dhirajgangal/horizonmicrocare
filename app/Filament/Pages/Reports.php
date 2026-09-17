<?php

namespace App\Filament\Pages;

use App\Enums\NavigationGroup;
use App\Filament\Actions\ExportCsvAction;
use App\Filament\Widgets\FoundationOverview;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class Reports extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartPie;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Administration;

    protected static ?string $navigationLabel = 'Reports';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.reports';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('dashboard.view') ?? false;
    }

    public function getTitle(): string|Htmlable
    {
        return 'Reports';
    }

    /**
     * @return array<class-string>
     */
    public function getHeaderWidgets(): array
    {
        return [
            FoundationOverview::class,
        ];
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            ExportCsvAction::make(
                'exportApplications',
                fn () => LoanApplication::query()->with('loanProduct'),
                [
                    'reference' => 'Reference',
                    'applicant_name' => 'Applicant',
                    'status' => 'Status',
                    'created_at' => 'Submitted',
                ],
                'application-report.csv',
            )->label('Export applications')->visible(fn (): bool => auth()->user()?->can('applications.export') ?? false),
            ExportCsvAction::make(
                'exportInquiries',
                fn () => Inquiry::query(),
                [
                    'name' => 'Name',
                    'email' => 'Email',
                    'subject' => 'Subject',
                    'status' => 'Status',
                    'created_at' => 'Received',
                ],
                'inquiry-report.csv',
            )->label('Export inquiries')->visible(fn (): bool => auth()->user()?->can('inquiries.export') ?? false),
        ];
    }
}
