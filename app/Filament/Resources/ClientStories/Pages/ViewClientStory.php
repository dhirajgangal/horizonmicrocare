<?php

namespace App\Filament\Resources\ClientStories\Pages;

use App\Filament\Resources\ClientStories\ClientStoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewClientStory extends ViewRecord
{
    protected static string $resource = ClientStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
