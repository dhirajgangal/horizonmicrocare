<?php

namespace App\Filament\Widgets;

use App\Enums\ApplicationStatus;
use App\Models\LoanApplication;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Schema;

class ApplicationStatusChart extends ChartWidget
{
    protected static bool $isLazy = false;

    protected ?string $heading = 'Application status';

    protected ?string $description = 'Current applications by review status.';

    protected ?string $maxHeight = '320px';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected ?string $emptyStateHeading = 'No application data available yet.';

    /**
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        if (! Schema::hasTable('loan_applications')) {
            return [];
        }

        $counts = LoanApplication::query()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $labels = [];
        $values = [];
        $colors = [];

        foreach (ApplicationStatus::cases() as $status) {
            $count = (int) ($counts[$status->value] ?? 0);

            if ($count === 0) {
                continue;
            }

            $labels[] = $status->label();
            $values[] = $count;
            $colors[] = match ($status) {
                ApplicationStatus::New => '#F15A24',
                ApplicationStatus::UnderReview => '#C47B17',
                ApplicationStatus::Approved => '#2F6F4E',
                ApplicationStatus::Rejected => '#B42318',
                ApplicationStatus::Archived => '#5C6570',
            };
        }

        if ($values === []) {
            return [];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $values,
                    'backgroundColor' => $colors,
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                    'hoverOffset' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'cutout' => '68%',
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                    'labels' => [
                        'boxWidth' => 12,
                        'padding' => 16,
                        'usePointStyle' => true,
                    ],
                ],
            ],
            'layout' => [
                'padding' => 8,
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
