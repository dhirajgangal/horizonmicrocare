<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('When')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('causer.name')
                    ->label('User')
                    ->placeholder('System')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Action')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('log_name')
                    ->label('Module')
                    ->badge()
                    ->placeholder('default'),
                TextColumn::make('subject_id')
                    ->label('Record ID')
                    ->placeholder('—'),
                TextColumn::make('event')
                    ->badge()
                    ->placeholder('—'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('log_name')
                    ->label('Module'),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->emptyStateHeading('No activity recorded yet.')
            ->emptyStateDescription('Admin changes will appear here for accountability.');
    }
}
