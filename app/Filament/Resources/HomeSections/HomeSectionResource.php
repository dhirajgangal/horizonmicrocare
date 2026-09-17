<?php

namespace App\Filament\Resources\HomeSections;

use App\Enums\NavigationGroup;
use App\Filament\Resources\HomeSections\Pages\ManageHomeSections;
use App\Filament\Support\AdminForm;
use App\Models\HomeSection;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class HomeSectionResource extends Resource
{
    protected static ?string $model = HomeSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::WebsiteContent;

    protected static ?string $navigationLabel = 'Home Sections';

    protected static ?int $navigationSort = 13;

    protected static ?string $recordTitleAttribute = 'heading';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('heading')
                    ->required(),
                TextInput::make('kicker'),
                AdminForm::richText('body', 'Body'),
                AdminForm::publicImage('image_path', 'home-sections'),
                TextInput::make('cta_label'),
                TextInput::make('cta_url')
                    ->url(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('heading')
            ->columns([
                TextColumn::make('heading')
                    ->searchable(),
                TextColumn::make('kicker')
                    ->searchable(),
                ImageColumn::make('image_path')->disk('public'),
                TextColumn::make('cta_label')
                    ->searchable(),
                TextColumn::make('cta_url')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageHomeSections::route('/'),
        ];
    }
}
