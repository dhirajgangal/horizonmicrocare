<?php

namespace App\Filament\Resources\CmsPages\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CmsPageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('type')
                            ->badge(),
                        TextEntry::make('excerpt')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('body')
                            ->html()
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Media & SEO')
                    ->schema([
                        ImageEntry::make('hero_image_path')
                            ->disk('public')
                            ->imageHeight(180)
                            ->placeholder('—'),
                        TextEntry::make('seo_title')
                            ->placeholder('—'),
                        TextEntry::make('seo_description')
                            ->placeholder('—')
                            ->columnSpanFull(),
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
