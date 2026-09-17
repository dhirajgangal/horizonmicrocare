<?php

namespace App\Filament\Resources\ClientStories;

use App\Enums\NavigationGroup;
use App\Filament\Resources\ClientStories\Pages\CreateClientStory;
use App\Filament\Resources\ClientStories\Pages\EditClientStory;
use App\Filament\Resources\ClientStories\Pages\ListClientStories;
use App\Filament\Resources\ClientStories\Pages\ViewClientStory;
use App\Filament\Resources\ClientStories\Schemas\ClientStoryForm;
use App\Filament\Resources\ClientStories\Schemas\ClientStoryInfolist;
use App\Filament\Resources\ClientStories\Tables\ClientStoriesTable;
use App\Models\ClientStory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ClientStoryResource extends Resource
{
    protected static ?string $model = ClientStory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::WebsiteContent;

    protected static ?string $navigationLabel = 'Client Stories';

    protected static ?int $navigationSort = 23;

    protected static ?string $recordTitleAttribute = 'headline';

    public static function form(Schema $schema): Schema
    {
        return ClientStoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClientStoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClientStoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClientStories::route('/'),
            'create' => CreateClientStory::route('/create'),
            'view' => ViewClientStory::route('/{record}'),
            'edit' => EditClientStory::route('/{record}/edit'),
        ];
    }
}
