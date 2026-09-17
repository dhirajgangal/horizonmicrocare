<?php

namespace App\Filament\Resources\LoanApplicationDocuments\Pages;

use App\Filament\Resources\LoanApplicationDocuments\LoanApplicationDocumentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLoanApplicationDocument extends ViewRecord
{
    protected static string $resource = LoanApplicationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
