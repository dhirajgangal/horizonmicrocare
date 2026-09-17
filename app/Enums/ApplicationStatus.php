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
            self::New => 'New',
            self::UnderReview => 'Under review',
            self::Accepted => 'Accepted for processing',
            self::Declined => 'Declined',
            self::Archived => 'Archived',
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
