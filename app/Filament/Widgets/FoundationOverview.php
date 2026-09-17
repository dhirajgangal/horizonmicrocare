<?php

namespace App\Filament\Widgets;

use App\Enums\ApplicationStatus;
use App\Enums\InquiryStatus;
use App\Enums\PublishStatus;
use App\Models\ClientStory;
use App\Models\GalleryImage;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class FoundationOverview extends StatsOverviewWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        if (! Schema::hasTable('loan_products')) {
            return [
                Stat::make('Loan products', '0'),
            ];
        }

        $applicationTrend = $this->dailyCounts(LoanApplication::class);
        $inquiryTrend = $this->dailyCounts(Inquiry::class);

        return [
            Stat::make('Total loan products', (string) LoanProduct::query()->count())
                ->description('Products in the catalogue')
                ->icon(Heroicon::OutlinedBanknotes)
                ->color('primary'),
            Stat::make('Total applications', (string) LoanApplication::query()->count())
                ->description('All submitted applications')
                ->descriptionIcon(Heroicon::OutlinedClipboardDocumentList)
                ->chart($applicationTrend)
                ->icon(Heroicon::OutlinedClipboardDocumentCheck)
                ->color('primary'),
            Stat::make('New applications', (string) LoanApplication::query()->where('status', ApplicationStatus::New)->count())
                ->description('Awaiting first review')
                ->icon(Heroicon::OutlinedSparkles)
                ->color('info'),
            Stat::make('Under review', (string) LoanApplication::query()->where('status', ApplicationStatus::UnderReview)->count())
                ->description('Currently being assessed')
                ->icon(Heroicon::OutlinedClock)
                ->color('warning'),
            Stat::make('Approved applications', (string) LoanApplication::query()->where('status', ApplicationStatus::Approved)->count())
                ->description('Marked approved in this system')
                ->icon(Heroicon::OutlinedCheckBadge)
                ->color('success'),
            Stat::make('Total inquiries', (string) Inquiry::query()->where('status', '!=', InquiryStatus::Closed)->count())
                ->description('Open and active inquiries')
                ->chart($inquiryTrend)
                ->icon(Heroicon::OutlinedInbox)
                ->color('primary'),
            Stat::make('Client stories', (string) ClientStory::query()->where('status', PublishStatus::Published)->count())
                ->description('Published stories')
                ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                ->color('success'),
            Stat::make('Gallery images', (string) GalleryImage::query()->where('is_active', true)->count())
                ->description('Active gallery images')
                ->icon(Heroicon::OutlinedPhoto)
                ->color('info'),
        ];
    }

    /**
     * @param  class-string  $model
     * @return array<int, int>
     */
    private function dailyCounts(string $model): array
    {
        $from = now()->subDays(6)->startOfDay();
        $counts = $model::query()
            ->where('created_at', '>=', $from)
            ->get(['created_at'])
            ->countBy(fn ($record): string => Carbon::parse($record->created_at)->toDateString());

        return collect(range(6, 0))
            ->map(fn (int $daysAgo): int => (int) ($counts[now()->subDays($daysAgo)->toDateString()] ?? 0))
            ->all();
    }
}
