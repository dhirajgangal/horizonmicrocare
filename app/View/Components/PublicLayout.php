<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PublicLayout extends Component
{
    /**
     * @param  list<array{label: string, url?: string}>  $breadcrumbs
     */
    public function __construct(
        public ?string $title = null,
        public array $breadcrumbs = [],
        public bool $lightbox = false,
    ) {}

    public function render(): View
    {
        return view('layouts.public');
    }
}
