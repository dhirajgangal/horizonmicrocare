<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
abstract class AdminComponent extends Component
{
    /**
     * @param  array<string, mixed>  $data
     */
    protected function page(string $view, string $title, array $data = []): View
    {
        return view($view, $data)->title($title);
    }
}
