<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ClientStories\ClientStoryResource;
use App\Filament\Resources\Faqs\FaqResource;
use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\LoanApplications\LoanApplicationResource;
use App\Filament\Resources\LoanProducts\LoanProductResource;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected string $view = 'filament.widgets.quick-actions';

    protected static bool $isLazy = false;

    protected static ?int $sort = 8;

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        return [
            'actions' => [
                [
                    'label' => 'Add loan product',
                    'url' => LoanProductResource::getUrl('create'),
                    'primary' => true,
                ],
                [
                    'label' => 'Add client story',
                    'url' => ClientStoryResource::getUrl('create'),
                    'primary' => false,
                ],
                [
                    'label' => 'Add gallery image',
                    'url' => GalleryImageResource::getUrl('create'),
                    'primary' => false,
                ],
                [
                    'label' => 'Add FAQ',
                    'url' => FaqResource::getUrl('index'),
                    'primary' => false,
                ],
                [
                    'label' => 'View applications',
                    'url' => LoanApplicationResource::getUrl('index'),
                    'primary' => false,
                ],
                [
                    'label' => 'View inquiries',
                    'url' => InquiryResource::getUrl('index'),
                    'primary' => false,
                ],
            ],
        ];
    }
}
