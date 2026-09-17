<?php

namespace App\Filament\Resources\LoanApplicationDocuments\Pages;

use App\Filament\Resources\LoanApplicationDocuments\LoanApplicationDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLoanApplicationDocument extends EditRecord
{
    protected static string $resource = LoanApplicationDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
