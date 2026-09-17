<?php

namespace App\Livewire\Admin\Faqs;

use App\Livewire\Admin\AdminComponent;
use App\Models\Faq;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public Faq $faq;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.faqs.show', 'View FAQ');
    }
}
