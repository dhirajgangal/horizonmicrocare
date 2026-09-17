<?php

namespace App\Livewire\Admin\Inquiries;

use App\Livewire\Admin\AdminComponent;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public Inquiry $inquiry;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.inquiries.show', 'View enquiry');
    }
}
