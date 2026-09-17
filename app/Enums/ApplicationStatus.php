<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case New = 'new';
    case UnderReview = 'under_review';
    case Accepted = 'accepted';
    case Declined = 'declined';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::New => __('New'),
            self::UnderReview => __('Under review'),
            self::Accepted => __('Accepted for processing'),
            self::Declined => __('Declined'),
            self::Archived => __('Archived'),
        };
    }

    public function tone(): string
    {
        return match ($this) {
            self::New => 'info',
            self::UnderReview => 'warning',
            self::Accepted => 'success',
            self::Declined => 'danger',
            self::Archived => 'muted',
        };
    }
}
