<?php

namespace App\Models;

use App\Concerns\LogsModelActivity;
use App\Enums\ApplicationStatus;
use Database\Factories\LoanApplicationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'loan_product_id',
    'requested_amount',
    'purpose',
    'full_name',
    'mobile',
    'email',
    'gender',
    'date_of_birth',
    'state',
    'district',
    'pincode',
    'address',
    'occupation',
    'monthly_income',
    'marital_status',
    'consent',
    'status',
    'internal_notes',
])]
class LoanApplication extends Model
{
    /** @use HasFactory<LoanApplicationFactory> */
    use HasFactory, LogsModelActivity, SoftDeletes;

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'new',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'requested_amount' => 'decimal:2',
            'date_of_birth' => 'date',
            'consent' => 'boolean',
            'status' => ApplicationStatus::class,
        ];
    }

    /**
     * @return BelongsTo<LoanProduct, $this>
     */
    public function loanProduct(): BelongsTo
    {
        return $this->belongsTo(LoanProduct::class);
    }
}
