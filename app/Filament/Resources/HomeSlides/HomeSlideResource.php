<?php

namespace App\Filament\Resources\HomeSlides;

use App\Enums\NavigationGroup;
use App\Enums\PublishStatus;
use App\Filament\Resources\HomeSlides\Pages\ManageHomeSlides;
use App\Filament\Support\AdminForm;
use App\Models\HomeSlide;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class HomeSlideResource extends Resource
{
    protected static ?string $model = HomeSlide::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::WebsiteContent;

    protected static ?string $navigationLabel = 'Home Carousel';

    protected static ?int $navigationSort = 11;

    protected static ?string $modelLabel = 'home slide';

    protected static ?string $pluralModelLabel = 'home slides';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle'),
                AdminForm::publicImage('image_path', 'slides', 'Desktop image')->required(),
                AdminForm::publicImage('mobile_image_path', 'slides', 'Mobile image'),
                TextInput::make('primary_cta_label'),
                TextInput::make('primary_cta_url')
                    ->url(),
                TextInput::make('secondary_cta_label'),
                TextInput::make('secondary_cta_url')
                    ->url(),
                Select::make('status')
                    ->options(PublishStatus::class)
                    ->default('draft')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('subtitle')
                    ->searchable(),
                ImageColumn::make('image_path')->disk('public'),
                ImageColumn::make('mobile_image_path')->disk('public'),
                TextColumn::make('primary_cta_label')
                    ->searchable(),
                TextColumn::make('primary_cta_url')
                    ->searchable(),
                TextColumn::make('secondary_cta_label')
                    ->searchable(),
                TextColumn::make('secondary_cta_url')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->dateTime()
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
            ])
            ->emptyStateHeading('No carousel slides found')
            ->emptyStateDescription('Add the first homepage slide.');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageHomeSlides::route('/'),
        ];
    }
}
