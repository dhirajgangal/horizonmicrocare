<?php

namespace App\Filament\Resources\LoanRequiredDocuments\Pages;

use App\Filament\Resources\LoanRequiredDocuments\LoanRequiredDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLoanRequiredDocuments extends ManageRecords
{
    protected static string $resource = LoanRequiredDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
