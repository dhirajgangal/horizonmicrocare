<?php

namespace App\Filament\Resources\LoanProducts\Pages;

use App\Filament\Resources\LoanProducts\LoanProductResource;
use App\Filament\Support\HasCombinedRelationTabs;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLoanProduct extends EditRecord
{
    use HasCombinedRelationTabs;

    protected static string $resource = LoanProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
