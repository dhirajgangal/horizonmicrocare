<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public User $user;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.users.show', 'View user');
    }
}
