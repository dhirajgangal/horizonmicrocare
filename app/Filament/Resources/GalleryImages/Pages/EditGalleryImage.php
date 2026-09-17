<?php

namespace App\Filament\Resources\GalleryImages\Pages;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditGalleryImage extends EditRecord
{
    protected static string $resource = GalleryImageResource::class;

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Gallery image updated successfully.');
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete gallery image?')
                ->modalDescription('Are you sure you want to delete this gallery image? The image file will also be removed.')
                ->successNotification(
                    Notification::make()->success()->title('Gallery image deleted successfully.')
                ),
        ];
    }

    /**
     * @return array<Action>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Save'),
            $this->getCancelFormAction(),
            Action::make('reset')
                ->label('Reset')
                ->color('gray')
                ->outlined()
                ->action(function (): void {
                    $this->fillForm();
                }),
        ];
    }
}
