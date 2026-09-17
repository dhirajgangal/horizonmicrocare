<?php

namespace App\Filament\Widgets;

use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Schema;

class LoanProductDistributionChart extends ChartWidget
{
    protected static bool $isLazy = false;

    protected ?string $heading = 'Applications by loan product';

    protected ?string $description = 'How submitted applications are distributed.';

    protected ?string $maxHeight = '320px';

    protected static ?int $sort = 3;

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
            ->selectRaw('loan_product_id, COUNT(*) as aggregate')
            ->groupBy('loan_product_id')
            ->pluck('aggregate', 'loan_product_id');

        if ($counts->sum() === 0) {
            return [];
        }

        $products = LoanProduct::query()
            ->whereIn('id', $counts->keys()->filter())
            ->pluck('name', 'id');

        $labels = [];
        $values = [];
        $colors = [];
        $palette = ['#F15A24', '#0B1F4A', '#2F6F4E', '#C47B17', '#1E3A6E'];

        foreach ($counts as $productId => $total) {
            $labels[] = $products[$productId] ?? 'Unassigned';
            $values[] = (int) $total;
            $colors[] = $palette[(count($values) - 1) % count($palette)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $values,
                    'backgroundColor' => $colors,
                    'borderRadius' => 8,
                    'maxBarThickness' => 28,
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
            'indexAxis' => 'y',
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                    'grid' => [
                        'drawBorder' => false,
                    ],
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
