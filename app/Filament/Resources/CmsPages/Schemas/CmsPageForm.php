<?php

namespace App\Filament\Resources\CmsPages\Schemas;

use App\Enums\CmsPageType;
use App\Enums\PublishStatus;
use App\Filament\Support\AdminForm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CmsPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('type')
                            ->options(CmsPageType::class)
                            ->default(CmsPageType::Generic)
                            ->required()
                            ->native(false),
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->columnSpanFull(),
                        AdminForm::richText('body', 'Content'),
                    ])
                    ->columns(2),
                Section::make('Media & SEO')
                    ->schema([
                        AdminForm::publicImage('hero_image_path', 'pages', 'Hero image'),
                        TextInput::make('seo_title')->maxLength(255),
                        Textarea::make('seo_description')->rows(3)->columnSpanFull(),
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
