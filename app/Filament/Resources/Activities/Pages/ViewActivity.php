<?php

namespace App\Filament\Resources\Activities\Pages;

use App\Filament\Resources\Activities\ActivityResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewActivity extends ViewRecord
{
    protected static string $resource = ActivityResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('causer.name')->label('User')->placeholder('System'),
                TextEntry::make('description')->label('Action'),
                TextEntry::make('log_name')->label('Module'),
                TextEntry::make('event'),
                TextEntry::make('subject_type'),
                TextEntry::make('subject_id')->label('Record ID'),
                TextEntry::make('properties')->label('Details')->formatStateUsing(
                    fn (mixed $state): string => is_array($state) || is_object($state)
                        ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                        : (string) $state
                ),
            ]);
    }
}
