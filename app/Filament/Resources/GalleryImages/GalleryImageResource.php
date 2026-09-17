<?php

namespace App\Filament\Resources\GalleryImages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\GalleryImages\Pages\CreateGalleryImage;
use App\Filament\Resources\GalleryImages\Pages\EditGalleryImage;
use App\Filament\Resources\GalleryImages\Pages\ListGalleryImages;
use App\Filament\Resources\GalleryImages\Pages\ViewGalleryImage;
use App\Filament\Support\AdminForm;
use App\Models\GalleryImage;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::WebsiteContent;

    protected static ?string $navigationLabel = 'Gallery Images';

    protected static ?int $navigationSort = 31;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        AdminForm::publicImage('image_path', 'gallery')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Select::make('gallery_category_id')
                            ->label('Category')
                            ->relationship('category', 'name', fn ($query) => $query->orderBy('sort_order')->orderBy('name'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                                TextInput::make('slug')->required()->maxLength(255),
                            ]),
                        TextInput::make('alt_text')
                            ->label('Alt text')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Describe the image for accessibility.'),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->schema([
                        AdminForm::sortOrder()->label('Display order'),
                        AdminForm::activeToggle(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        ImageEntry::make('image_path')
                            ->disk('public')
                            ->imageHeight(240)
                            ->columnSpanFull(),
                        TextEntry::make('title'),
                        TextEntry::make('category.name')->label('Category'),
                        TextEntry::make('description')->placeholder('—')->columnSpanFull(),
                        TextEntry::make('alt_text'),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->schema([
                        TextEntry::make('sort_order')->label('Display order'),
                        TextEntry::make('is_active')->badge()->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive'),
                        TextEntry::make('created_at')->dateTime(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->square()
                    ->imageHeight(56),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Display order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('gallery_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_active')->label('Active'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Delete gallery image?')
                    ->modalDescription('Are you sure you want to delete this gallery image? The image file will also be removed.'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('No gallery images found')
            ->emptyStateDescription('Upload the first image to start the gallery.')
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGalleryImages::route('/'),
            'create' => CreateGalleryImage::route('/create'),
            'view' => ViewGalleryImage::route('/{record}'),
            'edit' => EditGalleryImage::route('/{record}/edit'),
        ];
    }
}
