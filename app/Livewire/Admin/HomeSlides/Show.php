<?php

namespace App\Livewire\Admin\HomeSlides;

use App\Livewire\Admin\AdminComponent;
use App\Models\HomeSlide;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public HomeSlide $homeSlide;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.home-slides.show', 'View slide');
    }
}
