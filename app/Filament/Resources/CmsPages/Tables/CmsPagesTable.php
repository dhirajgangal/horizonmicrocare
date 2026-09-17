<?php

namespace App\Filament\Resources\CmsPages\Tables;

use App\Enums\CmsPageType;
use App\Enums\PublishStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CmsPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('type')->badge(),
                TextColumn::make('status')->badge(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->defaultSort('title')
            ->filters([
                SelectFilter::make('type')->options(CmsPageType::class),
                SelectFilter::make('status')->options(PublishStatus::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('No pages found')
            ->emptyStateDescription('Create About, Mission, Vision, Values, or legal pages.')
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }
}
