<?php

namespace App\Models;

use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['gallery_category_id', 'title', 'description', 'image_path', 'alt_text', 'is_active', 'sort_order'])]
class GalleryImage extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (GalleryImage $image): void {
            if (is_array($image->image_path)) {
                $image->image_path = collect($image->image_path)->filter()->first();
            }
        });

        static::updating(function (GalleryImage $image): void {
            if (! $image->isDirty('image_path')) {
                return;
            }

            $original = $image->getOriginal('image_path');

            if (is_string($original)) {
                static::deleteStoredImage($original);
            }
        });

        static::deleting(function (GalleryImage $image): void {
            if (is_string($image->image_path)) {
                static::deleteStoredImage($image->image_path);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function imageUrl(): ?string
    {
        if (! is_string($this->image_path) || $this->image_path === '') {
            return null;
        }

        return Storage::disk('public')->url($this->image_path);
    }

    private static function deleteStoredImage(string $path): void
    {
        if (! str_starts_with($path, 'gallery/')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
