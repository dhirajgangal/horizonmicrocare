<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CmsPageType: string implements HasLabel
{
    case Legal = 'legal';
    case Generic = 'generic';

    public function label(): string
    {
        return match ($this) {
            self::Legal => 'Legal',
            self::Generic => 'Page',
        };
    }

    public function getLabel(): string
    {
        return $this->label();
    }
}
