<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use App\Enums\InquiryStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry')
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('email')->label('Email address')->email(),
                        TextInput::make('mobile')->tel(),
                        TextInput::make('subject')->maxLength(255),
                        Textarea::make('message')->required()->rows(5)->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Status & notes')
                    ->schema([
                        Select::make('status')
                            ->options(InquiryStatus::class)
                            ->default(InquiryStatus::New)
                            ->required()
                            ->native(false),
                        Textarea::make('internal_notes')
                            ->label('Internal notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
