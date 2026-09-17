<?php

namespace App\Models;

use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['loan_product_id', 'title', 'description', 'is_required', 'sort_order'])]
class LoanRequiredDocument extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
        ];
    }

    public function loanProduct(): BelongsTo
    {
        return $this->belongsTo(LoanProduct::class);
    }
}
