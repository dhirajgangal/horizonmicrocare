<?php

namespace App\Filament\Resources\ClientStories\Pages;

use App\Filament\Resources\ClientStories\ClientStoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClientStories extends ListRecords
{
    protected static string $resource = ClientStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
