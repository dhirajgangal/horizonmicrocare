<?php

namespace App\Livewire\Admin;

use App\Enums\ApplicationStatus;
use App\Enums\InquiryStatus;
use App\Models\ClientStory;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class Dashboard extends AdminComponent
{
    public function render(): View
    {
        $applicationCounts = [];

        foreach (ApplicationStatus::cases() as $status) {
            $applicationCounts[$status->value] = LoanApplication::query()->where('status', $status)->count();
        }

        $days = collect(range(13, 0))->map(fn (int $day): Carbon => now()->subDays($day)->startOfDay());

        $applicationDaily = LoanApplication::query()
            ->where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->get()
            ->groupBy(fn (LoanApplication $application): string => $application->created_at->toDateString())
            ->map->count();

        $inquiryDaily = Inquiry::query()
            ->where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->get()
            ->groupBy(fn (Inquiry $inquiry): string => $inquiry->created_at->toDateString())
            ->map->count();

        return $this->page('livewire.admin.dashboard', __('Dashboard'), [
            'productCount' => LoanProduct::query()->count(),
            'applicationCounts' => $applicationCounts,
            'inquiryCount' => Inquiry::query()->count(),
            'storyCount' => ClientStory::query()->count(),
            'galleryCount' => GalleryImage::query()->count(),
            'faqCount' => Faq::query()->count(),
            'newInquiries' => Inquiry::query()->where('status', InquiryStatus::New)->count(),
            'recentApplications' => LoanApplication::query()->with('loanProduct')->latest('id')->limit(6)->get(),
            'recentInquiries' => Inquiry::query()->latest('id')->limit(6)->get(),
            'chartStatus' => [
                'labels' => array_map(fn (ApplicationStatus $status): string => $status->label(), ApplicationStatus::cases()),
                'values' => array_values($applicationCounts),
            ],
            'chartTrend' => [
                'labels' => $days->map(fn (Carbon $day): string => $day->format('d M'))->all(),
                'applications' => $days->map(fn (Carbon $day): int => (int) ($applicationDaily[$day->toDateString()] ?? 0))->all(),
                'inquiries' => $days->map(fn (Carbon $day): int => (int) ($inquiryDaily[$day->toDateString()] ?? 0))->all(),
            ],
            'chartContent' => [
                'labels' => [__('Loan products'), __('Stories'), __('Gallery'), __('FAQs')],
                'values' => [
                    LoanProduct::query()->count(),
                    ClientStory::query()->count(),
                    GalleryImage::query()->count(),
                    Faq::query()->count(),
                ],
            ],
        ]);
    }
}
