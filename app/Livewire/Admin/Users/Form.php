<?php

namespace App\Livewire\Admin\Users;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class Form extends AdminComponent
{
    use FinishesAdminSave;

    public ?int $userId = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public function mount(?User $user = null): void
    {
        if (! $user?->exists) {
            return;
        }

        $this->userId = $user->id;
        $this->fill($user->only(['name', 'email']));
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => [$this->userId ? 'nullable' : 'required', 'string', Password::min(8)],
        ]);

        if (blank($data['password'])) {
            unset($data['password']);
        }

        $user = User::query()->updateOrCreate(['id' => $this->userId], $data);
        $user->assignRole(Role::findOrCreate('Super Admin', 'web'));

        $this->finishSave($this->userId ? __('Updated') : __('Saved'), 'admin.users.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.users.form', $this->userId ? __('Edit user') : __('Create user'));
    }
}
