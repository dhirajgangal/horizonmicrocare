<?php

namespace App\Filament\Resources\ClientStories\Pages;

use App\Filament\Resources\ClientStories\ClientStoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClientStory extends CreateRecord
{
    protected static string $resource = ClientStoryResource::class;
}
