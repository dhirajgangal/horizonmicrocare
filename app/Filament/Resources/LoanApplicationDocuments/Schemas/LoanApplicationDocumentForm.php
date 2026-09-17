<?php

namespace App\Filament\Resources\LoanApplicationDocuments\Schemas;

use App\Filament\Support\AdminForm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanApplicationDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Document')
                    ->schema([
                        Select::make('loan_application_id')
                            ->relationship('application', 'reference')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        AdminForm::privateDocument('file_path', 'application-documents')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
