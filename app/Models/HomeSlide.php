<?php

namespace App\Models;

use App\Enums\PublishStatus;
use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'subtitle',
    'image_path',
    'mobile_image_path',
    'primary_cta_label',
    'primary_cta_url',
    'secondary_cta_label',
    'secondary_cta_url',
    'status',
    'sort_order',
    'published_at',
])]
class HomeSlide extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
            'published_at' => 'datetime',
        ];
    }
}
