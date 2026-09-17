<?php

namespace App\Filament\Resources\ClientStories\Schemas;

use App\Enums\PublishStatus;
use App\Filament\Support\AdminForm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientStoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic information')
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('location')->maxLength(255),
                        TextInput::make('headline')->required()->maxLength(255)->columnSpanFull(),
                        AdminForm::richText('story', 'Story'),
                    ])
                    ->columns(2),
                Section::make('Additional information')
                    ->schema([
                        AdminForm::publicImage('photo_path', 'client-stories', 'Photo'),
                        AdminForm::sortOrder(),
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
