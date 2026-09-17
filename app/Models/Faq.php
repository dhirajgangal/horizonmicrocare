<?php

namespace App\Models;

use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['question', 'answer', 'category', 'is_active', 'sort_order'])]
class Faq extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
