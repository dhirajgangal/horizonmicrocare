<?php

namespace App\Filament\Resources\LoanApplications\Schemas;

use App\Enums\ApplicationStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Applicant')
                    ->schema([
                        TextInput::make('reference')
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Generated automatically when the application is created.'),
                        Select::make('loan_product_id')
                            ->relationship('loanProduct', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('applicant_name')->required()->maxLength(255),
                        TextInput::make('email')->label('Email address')->email(),
                        TextInput::make('mobile')->required()->tel(),
                        TextInput::make('city'),
                        TextInput::make('state'),
                        TextInput::make('requested_amount')->numeric()->prefix('₹'),
                        Textarea::make('purpose')->columnSpanFull()->rows(3),
                    ])
                    ->columns(2),
                Section::make('Status & notes')
                    ->schema([
                        Select::make('status')
                            ->options(ApplicationStatus::class)
                            ->default(ApplicationStatus::New)
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
