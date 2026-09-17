<?php

namespace App\Models;

use App\Concerns\LogsModelActivity;
use Database\Factories\ClientStoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Fillable([
    'name',
    'slug',
    'photo',
    'feedback',
    'location',
    'is_published',
    'sort_order',
])]
class ClientStory extends Model
{
    /** @use HasFactory<ClientStoryFactory> */
    use HasFactory, LogsModelActivity;

    protected static function booted(): void
    {
        static::saving(function (ClientStory $story): void {
            if (filled($story->slug)) {
                return;
            }

            $story->slug = Str::slug($story->name).'-'.Str::lower(Str::random(6));
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @param  Builder<ClientStory>  $query
     * @return Builder<ClientStory>
     */
    #[Scope]
    protected function published(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order')->orderByDesc('id');
    }

    public function photoUrl(): string
    {
        return Storage::disk('public')->url($this->photo);
    }
}
