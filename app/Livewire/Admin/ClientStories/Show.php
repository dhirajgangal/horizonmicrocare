<?php

namespace App\Livewire\Admin\ClientStories;

use App\Livewire\Admin\AdminComponent;
use App\Models\ClientStory;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public ClientStory $clientStory;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.client-stories.show', 'View story');
    }
}
