<?php

namespace App\Filament\Resources\LoanApplications\Schemas;

use App\Models\LoanApplication;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanApplicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Applicant')
                    ->schema([
                        TextEntry::make('reference'),
                        TextEntry::make('loanProduct.name')
                            ->label('Loan product')
                            ->placeholder('—'),
                        TextEntry::make('applicant_name'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->placeholder('—'),
                        TextEntry::make('mobile'),
                        TextEntry::make('city')
                            ->placeholder('—'),
                        TextEntry::make('state')
                            ->placeholder('—'),
                        TextEntry::make('requested_amount')
                            ->numeric(decimalPlaces: 2)
                            ->prefix('₹')
                            ->placeholder('—'),
                        TextEntry::make('purpose')
                            ->placeholder('—')
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
                            ->visible(fn (LoanApplication $record): bool => $record->trashed()),
                    ])
                    ->columns(2),
            ]);
    }
}
