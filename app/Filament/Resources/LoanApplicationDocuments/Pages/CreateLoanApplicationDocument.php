<?php

namespace App\Filament\Resources\LoanApplicationDocuments\Pages;

use App\Filament\Resources\LoanApplicationDocuments\LoanApplicationDocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLoanApplicationDocument extends CreateRecord
{
    protected static string $resource = LoanApplicationDocumentResource::class;
}
