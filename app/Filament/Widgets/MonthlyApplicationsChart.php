<?php

namespace App\Filament\Widgets;

use App\Models\LoanApplication;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class MonthlyApplicationsChart extends ChartWidget
{
    protected static bool $isLazy = false;

    protected ?string $heading = 'Application trends';

    protected ?string $description = 'Applications received in the last 12 months.';

    protected ?string $maxHeight = '320px';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected ?string $emptyStateHeading = 'No application data available yet.';

    /**
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        if (! Schema::hasTable('loan_applications')) {
            return [];
        }

        $from = now()->subMonths(11)->startOfMonth();
        $counts = LoanApplication::query()
            ->where('created_at', '>=', $from)
            ->get(['created_at'])
            ->countBy(fn (LoanApplication $application): string => Carbon::parse($application->created_at)->format('Y-m'));

        $labels = [];
        $values = [];

        foreach (range(11, 0) as $monthsAgo) {
            $month = now()->subMonths($monthsAgo)->startOfMonth();
            $key = $month->format('Y-m');
            $labels[] = $month->format('M Y');
            $values[] = (int) ($counts[$key] ?? 0);
        }

        if (collect($values)->sum() === 0) {
            return [];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $values,
                    'borderColor' => '#F15A24',
                    'backgroundColor' => 'rgba(241, 90, 36, 0.16)',
                    'fill' => true,
                    'tension' => 0.35,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                    'pointBackgroundColor' => '#F15A24',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
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
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'suggestedMax' => 4,
                    'ticks' => [
                        'precision' => 0,
                        'stepSize' => 1,
                    ],
                    'grid' => [
                        'drawBorder' => false,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
