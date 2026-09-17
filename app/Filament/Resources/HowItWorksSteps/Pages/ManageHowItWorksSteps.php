<?php

namespace App\Filament\Resources\HowItWorksSteps\Pages;

use App\Filament\Resources\HowItWorksSteps\HowItWorksStepResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHowItWorksSteps extends ManageRecords
{
    protected static string $resource = HowItWorksStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
