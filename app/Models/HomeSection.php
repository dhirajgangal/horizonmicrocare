<?php

namespace App\Models;

use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['heading', 'kicker', 'body', 'image_path', 'cta_label', 'cta_url', 'is_active', 'sort_order'])]
class HomeSection extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
