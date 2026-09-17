<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum NavigationGroup: string implements HasLabel
{
    case LoanManagement = 'Loan Management';
    case WebsiteContent = 'Website Content';
    case CustomerManagement = 'Customer Management';
    case WebsiteSettings = 'Website Settings';
    case Administration = 'Administration';

    public function getLabel(): string
    {
        return $this->value;
    }
}
