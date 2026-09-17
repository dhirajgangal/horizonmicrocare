<?php

namespace App\Livewire\Admin\LoanApplications;

use App\Livewire\Admin\AdminComponent;
use App\Models\LoanApplication;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public LoanApplication $loanApplication;

    public bool $embedded = false;

    public function mount(LoanApplication $loanApplication): void
    {
        $this->loanApplication = $loanApplication->load('loanProduct');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.loan-applications.show', 'View application');
    }
}
