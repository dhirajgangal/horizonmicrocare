<?php

namespace App\Filament\Resources\GalleryCategories\RelationManagers;

use App\Filament\Support\AdminForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                AdminForm::publicImage('image_path', 'gallery')->required(),
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('alt_text')->required()->maxLength(255),
                AdminForm::activeToggle(),
                AdminForm::sortOrder()->label('Display order'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image_path')->disk('public')->square(),
                TextColumn::make('title')->searchable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort_order')->label('Display order')->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ]);
    }
}
