<?php

namespace App\Models;

use App\Concerns\LogsModelActivity;
use Database\Factories\HomeSlideFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'image',
    'kicker',
    'heading',
    'text',
    'cta_label',
    'cta_url',
    'is_active',
    'sort_order',
])]
class HomeSlide extends Model
{
    /** @use HasFactory<HomeSlideFactory> */
    use HasFactory, LogsModelActivity;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @param  Builder<HomeSlide>  $query
     * @return Builder<HomeSlide>
     */
    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->image);
    }
}
