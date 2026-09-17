<?php

namespace App\Models;

use App\Enums\InquiryStatus;
use App\Models\Concerns\LogsCmsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email', 'mobile', 'subject', 'message', 'status', 'internal_notes'])]
class Inquiry extends Model
{
    use LogsCmsActivity;
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => InquiryStatus::class,
        ];
    }

    public function notes(): HasMany
    {
        return $this->hasMany(InquiryNote::class)->latest();
    }
}
