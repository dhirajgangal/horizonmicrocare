<?php

namespace App\Concerns\Livewire\Admin;

use App\Support\Toast;

trait FinishesAdminSave
{
    public bool $embedded = false;

    protected function finishSave(string $message, ?string $redirectRoute = null, mixed $redirectParam = null): void
    {
        if ($this->embedded) {
            $this->dispatch('toast', type: 'success', message: $message);
            $this->dispatch('record-saved');

            return;
        }

        Toast::success($message);

        if ($redirectRoute) {
            $this->redirect(route($redirectRoute, $redirectParam), navigate: true);
        }
    }
}
