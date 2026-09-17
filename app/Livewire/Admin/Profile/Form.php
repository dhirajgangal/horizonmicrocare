<?php

namespace App\Livewire\Admin\Profile;

use App\Livewire\Admin\AdminComponent;
use App\Support\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rules\Password;

class Form extends AdminComponent
{
    public string $name = '';

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->name = (string) auth()->user()?->name;
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:120'],
            'current_password' => ['required', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();
        $user->name = $data['name'];

        if (filled($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        $this->reset(['current_password', 'password', 'password_confirmation']);

        Toast::success(__('Updated'));
    }

    public function render(): View
    {
        return $this->page('livewire.admin.profile.form', __('My profile'), [
            'email' => auth()->user()?->email,
        ]);
    }
}
