<?php

namespace App\Models;

use App\Concerns\LogsModelActivity;
use Database\Factories\LoanProductFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'name',
    'slug',
    'short_description',
    'description',
    'features',
    'eligibility',
    'required_documents',
    'is_active',
    'sort_order',
])]
class LoanProduct extends Model
{
    /** @use HasFactory<LoanProductFactory> */
    use HasFactory, LogsModelActivity;

    protected static function booted(): void
    {
        static::saving(function (LoanProduct $product): void {
            if (filled($product->slug)) {
                return;
            }

            $product->slug = Str::slug($product->name);
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return HasMany<LoanApplication, $this>
     */
    public function applications(): HasMany
    {
        return $this->hasMany(LoanApplication::class);
    }

    /**
     * @param  Builder<LoanProduct>  $query
     * @return Builder<LoanProduct>
     */
    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('name');
    }
}
