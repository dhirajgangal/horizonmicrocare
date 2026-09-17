<?php

namespace App\Filament\Support;

trait HasCombinedRelationTabs
{
    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Details';
    }
}
