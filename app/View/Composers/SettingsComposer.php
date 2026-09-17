<?php

namespace App\View\Composers;

use App\Services\SiteSettings;
use Illuminate\View\View;

class SettingsComposer
{
    public function __construct(private SiteSettings $settings) {}

    public function compose(View $view): void
    {
        $view->with('site', $this->settings->current());
    }
}
