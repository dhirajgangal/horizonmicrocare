<?php

namespace App\Filament\Resources\LoanApplicationDocuments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanApplicationDocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Document')
                    ->schema([
                        TextEntry::make('application.reference')
                            ->label('Application'),
                        TextEntry::make('title'),
                        TextEntry::make('original_name')
                            ->placeholder('—'),
                        TextEntry::make('mime_type')
                            ->placeholder('—'),
                        TextEntry::make('file_path')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Record')
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('—'),
                    ])
                    ->columns(2),
            ]);
    }
}
