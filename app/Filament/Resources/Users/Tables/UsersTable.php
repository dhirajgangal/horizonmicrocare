<?php

namespace App\Filament\Resources\Users\Tables;

use App\Enums\UserStatus;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('mobile')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('roles.name')
                    ->badge()
                    ->separator(','),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (UserStatus $state): string => $state->label())
                    ->color(fn (UserStatus $state): string => $state === UserStatus::Active ? 'success' : 'danger'),
                TextColumn::make('last_login_at')
                    ->dateTime()
                    ->placeholder('Never')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(UserStatus::cases())->mapWithKeys(
                        fn (UserStatus $status): array => [$status->value => $status->label()]
                    )),
                SelectFilter::make('roles')
                    ->relationship('roles', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('deactivate')
                    ->label('Deactivate')
                    ->color('danger')
                    ->visible(fn (User $record): bool => $record->status === UserStatus::Active)
                    ->requiresConfirmation()
                    ->modalHeading('Deactivate admin user?')
                    ->modalDescription('This user will no longer be able to sign in.')
                    ->action(fn (User $record) => $record->update(['status' => UserStatus::Inactive])),
                Action::make('activate')
                    ->label('Activate')
                    ->color('success')
                    ->visible(fn (User $record): bool => $record->status === UserStatus::Inactive)
                    ->requiresConfirmation()
                    ->modalHeading('Activate admin user?')
                    ->action(fn (User $record) => $record->update(['status' => UserStatus::Active])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No admin users found.')
            ->emptyStateDescription('Create the first administrator to manage this website.')
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }
}
