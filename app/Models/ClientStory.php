<?php

namespace App\Models;

use App\Enums\PublishStatus;
use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'location', 'headline', 'story', 'photo_path', 'status', 'sort_order'])]
class ClientStory extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
        ];
    }
}
