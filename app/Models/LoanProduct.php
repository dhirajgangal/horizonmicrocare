<?php

namespace App\Models;

use App\Enums\PublishStatus;
use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'summary',
    'description',
    'image_path',
    'amount_range',
    'tenure_range',
    'status',
    'sort_order',
])]
class LoanProduct extends Model
{
    use LogsCmsActivity;

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
        ];
    }

    public function features(): HasMany
    {
        return $this->hasMany(LoanFeature::class)->orderBy('sort_order');
    }

    public function eligibilityItems(): HasMany
    {
        return $this->hasMany(LoanEligibilityItem::class)->orderBy('sort_order');
    }

    public function requiredDocuments(): HasMany
    {
        return $this->hasMany(LoanRequiredDocument::class)->orderBy('sort_order');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(LoanFaq::class)->orderBy('sort_order');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(LoanApplication::class);
    }
}
