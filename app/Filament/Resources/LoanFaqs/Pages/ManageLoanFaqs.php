<?php

namespace App\Filament\Resources\LoanFaqs\Pages;

use App\Filament\Resources\LoanFaqs\LoanFaqResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLoanFaqs extends ManageRecords
{
    protected static string $resource = LoanFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
