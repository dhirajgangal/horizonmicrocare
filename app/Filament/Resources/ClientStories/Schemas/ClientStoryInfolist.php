<?php

namespace App\Filament\Resources\ClientStories\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientStoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('location')
                            ->placeholder('—'),
                        TextEntry::make('headline')
                            ->columnSpanFull(),
                        TextEntry::make('story')
                            ->html()
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Additional information')
                    ->schema([
                        ImageEntry::make('photo_path')
                            ->disk('public')
                            ->imageHeight(180)
                            ->placeholder('—'),
                        TextEntry::make('sort_order')
                            ->numeric(),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->schema([
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('—'),
                    ])
                    ->columns(3),
            ]);
    }
}
