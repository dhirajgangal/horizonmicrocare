<?php

namespace App\Models;

use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'icon', 'is_active', 'sort_order'])]
class WhyChooseUsItem extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
