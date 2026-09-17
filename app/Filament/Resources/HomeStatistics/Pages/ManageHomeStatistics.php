<?php

namespace App\Filament\Resources\HomeStatistics\Pages;

use App\Filament\Resources\HomeStatistics\HomeStatisticResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHomeStatistics extends ManageRecords
{
    protected static string $resource = HomeStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
