<?php

namespace App\Filament\Resources\LoanProducts\Schemas;

use App\Enums\PublishStatus;
use App\Filament\Support\AdminForm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LoanProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('summary')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        AdminForm::richText('description', 'Description'),
                    ])
                    ->columns(2),
                Section::make('Additional information')
                    ->schema([
                        AdminForm::publicImage('image_path', 'loan-products', 'Product image'),
                        TextInput::make('amount_range')
                            ->placeholder('e.g. As published by the organization'),
                        TextInput::make('tenure_range')
                            ->placeholder('e.g. As published by the organization'),
                        AdminForm::sortOrder(),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->options(PublishStatus::class)
                            ->default(PublishStatus::Draft)
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }
}
