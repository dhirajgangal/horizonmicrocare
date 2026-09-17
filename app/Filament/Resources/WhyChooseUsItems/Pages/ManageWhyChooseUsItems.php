<?php

namespace App\Filament\Resources\WhyChooseUsItems\Pages;

use App\Filament\Resources\WhyChooseUsItems\WhyChooseUsItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWhyChooseUsItems extends ManageRecords
{
    protected static string $resource = WhyChooseUsItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
