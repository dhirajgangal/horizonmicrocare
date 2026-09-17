<?php

namespace App\Enums;

enum InquiryStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Resolved = 'resolved';
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::New => __('New'),
            self::InProgress => __('In progress'),
            self::Resolved => __('Resolved'),
            self::Closed => __('Closed'),
        };
    }

    public function tone(): string
    {
        return match ($this) {
            self::New => 'info',
            self::InProgress => 'warning',
            self::Resolved => 'success',
            self::Closed => 'muted',
        };
    }
}
