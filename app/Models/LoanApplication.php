<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[Fillable([
    'reference',
    'loan_product_id',
    'applicant_name',
    'email',
    'mobile',
    'city',
    'state',
    'requested_amount',
    'purpose',
    'status',
    'internal_notes',
])]
class LoanApplication extends Model
{
    use LogsCmsActivity;
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => ApplicationStatus::class,
            'requested_amount' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (LoanApplication $application): void {
            if (filled($application->reference)) {
                return;
            }

            $application->reference = 'HMA-'.now()->format('Ymd').'-'.strtoupper(Str::random(5));
        });
    }

    public function loanProduct(): BelongsTo
    {
        return $this->belongsTo(LoanProduct::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(LoanApplicationNote::class)->latest();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(LoanApplicationDocument::class)->latest();
    }
}
