<?php

namespace App\Livewire\Admin\LoanApplications;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Enums\ApplicationStatus;
use App\Livewire\Admin\AdminComponent;
use App\Models\LoanApplication;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Form extends AdminComponent
{
    use FinishesAdminSave;

    public LoanApplication $loanApplication;

    public string $status;

    public string $internal_notes = '';

    public function mount(LoanApplication $loanApplication): void
    {
        $this->loanApplication = $loanApplication;
        $this->status = $loanApplication->status->value;
        $this->internal_notes = (string) $loanApplication->internal_notes;
    }

    public function save(): void
    {
        $data = $this->validate([
            'status' => ['required', Rule::enum(ApplicationStatus::class)],
            'internal_notes' => ['nullable', 'string'],
        ]);

        $this->loanApplication->update($data);

        $this->finishSave(__('Updated'), 'admin.loan-applications.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.loan-applications.form', 'Update application');
    }
}
