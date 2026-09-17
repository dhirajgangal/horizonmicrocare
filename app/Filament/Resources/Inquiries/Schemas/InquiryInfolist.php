<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use App\Models\Inquiry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InquiryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->placeholder('—'),
                        TextEntry::make('mobile')
                            ->placeholder('—'),
                        TextEntry::make('subject')
                            ->placeholder('—'),
                        TextEntry::make('message')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Status & notes')
                    ->schema([
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('internal_notes')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),
                Section::make('Record')
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn (Inquiry $record): bool => $record->trashed()),
                    ])
                    ->columns(2),
            ]);
    }
}
