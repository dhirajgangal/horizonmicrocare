<?php

namespace App\Filament\Resources\LoanApplicationDocuments\Pages;

use App\Filament\Resources\LoanApplicationDocuments\LoanApplicationDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLoanApplicationDocuments extends ListRecords
{
    protected static string $resource = LoanApplicationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
