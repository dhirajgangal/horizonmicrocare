<?php

namespace App\Filament\Resources\LoanFeatures\Pages;

use App\Filament\Resources\LoanFeatures\LoanFeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLoanFeatures extends ManageRecords
{
    protected static string $resource = LoanFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
