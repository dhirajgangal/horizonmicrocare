<?php

namespace App\Filament\Resources\LoanEligibilityItems\Pages;

use App\Filament\Resources\LoanEligibilityItems\LoanEligibilityItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLoanEligibilityItems extends ManageRecords
{
    protected static string $resource = LoanEligibilityItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
