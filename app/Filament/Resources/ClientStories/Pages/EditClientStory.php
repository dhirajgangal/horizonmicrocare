<?php

namespace App\Filament\Resources\ClientStories\Pages;

use App\Filament\Resources\ClientStories\ClientStoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditClientStory extends EditRecord
{
    protected static string $resource = ClientStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
