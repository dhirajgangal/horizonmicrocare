<?php

namespace App\Filament\Support;

use App\Enums\PublishStatus;
use App\Support\HtmlSanitizer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class AdminForm
{
    public static function statusSelect(string $name = 'status'): Select
    {
        return Select::make($name)
            ->options(collect(PublishStatus::cases())->mapWithKeys(
                fn (PublishStatus $status): array => [$status->value => $status->label()]
            ))
            ->default(PublishStatus::Draft->value)
            ->required()
            ->native(false);
    }

    public static function activeToggle(string $name = 'is_active'): Toggle
    {
        return Toggle::make($name)
            ->label('Active')
            ->default(true);
    }

    public static function sortOrder(string $name = 'sort_order'): TextInput
    {
        return TextInput::make($name)
            ->numeric()
            ->default(0)
            ->required()
            ->minValue(0);
    }

    public static function publicImage(string $name, string $directory, string $label = 'Image'): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->visibility('public')
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->maxSize(4096)
            ->maxFiles(1)
            ->imagePreviewHeight('240')
            ->panelLayout('integrated')
            ->openable()
            ->downloadable()
            ->moveFiles()
            ->removeUploadedFileButtonPosition('right')
            ->uploadButtonPosition('left')
            ->placeholder('Choose image')
            ->uploadingMessage('Uploading image...')
            ->validationAttribute($label)
            ->validationMessages([
                'max' => 'Image size must not exceed the allowed limit.',
                'mimetypes' => 'Please choose a JPG, PNG, or WebP image.',
                'image' => 'Please choose a valid image file.',
            ])
            ->helperText('Drag and drop or choose a JPG, PNG, or WebP image up to 4 MB.')
            ->dehydrateStateUsing(function (mixed $state): ?string {
                if (is_array($state)) {
                    $path = collect($state)->filter()->first();

                    return is_string($path) ? $path : null;
                }

                return is_string($state) && $state !== '' ? $state : null;
            });
    }

    public static function privateDocument(string $name, string $directory, string $label = 'Document'): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('local')
            ->directory($directory)
            ->visibility('private')
            ->acceptedFileTypes([
                'application/pdf',
                'image/png',
                'image/jpeg',
                'image/webp',
            ])
            ->maxSize(8192)
            ->downloadable()
            ->previewable()
            ->helperText('Private file. PDF or image up to 8 MB. Not published on the website.');
    }

    public static function richText(string $name, string $label = 'Content'): RichEditor
    {
        return RichEditor::make($name)
            ->label($label)
            ->columnSpanFull()
            ->toolbarButtons([
                'bold',
                'italic',
                'underline',
                'bulletList',
                'orderedList',
                'link',
                'h2',
                'h3',
                'blockquote',
                'undo',
                'redo',
            ])
            ->dehydrateStateUsing(fn (?string $state): ?string => HtmlSanitizer::clean($state));
    }
}
