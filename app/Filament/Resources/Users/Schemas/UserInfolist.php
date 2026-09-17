<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email')->label('Email address'),
                        TextEntry::make('mobile')->placeholder('—'),
                        TextEntry::make('last_login_at')->dateTime()->placeholder('Never'),
                    ])
                    ->columns(2),
                Section::make('Access')
                    ->schema([
                        TextEntry::make('status')->badge(),
                        TextEntry::make('roles.name')->badge(),
                        TextEntry::make('created_at')->dateTime(),
                    ])
                    ->columns(3),
            ]);
    }
}
