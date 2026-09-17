<?php

namespace App\Models;

use App\Enums\CmsPageType;
use App\Enums\PublishStatus;
use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'type',
    'hero_image_path',
    'excerpt',
    'body',
    'seo_title',
    'seo_description',
    'status',
])]
class CmsPage extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'type' => CmsPageType::class,
            'status' => PublishStatus::class,
        ];
    }
}
