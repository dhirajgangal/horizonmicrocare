<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DashboardWelcome extends Widget
{
    protected string $view = 'filament.widgets.dashboard-welcome';

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 0;

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $name = auth()->user()?->name ?? 'Admin';

        return [
            'greeting' => 'Welcome back, '.$name,
            'intro' => 'Manage loan information, applications, website content, and customer inquiries from one place.',
        ];
    }
}
