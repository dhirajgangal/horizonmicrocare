<?php

namespace App\Filament\Resources\LoanProducts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('slug'),
                        TextEntry::make('summary')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('description')
                            ->html()
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Additional information')
                    ->schema([
                        ImageEntry::make('image_path')
                            ->disk('public')
                            ->imageHeight(180)
                            ->placeholder('—'),
                        TextEntry::make('amount_range')
                            ->placeholder('—'),
                        TextEntry::make('tenure_range')
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
