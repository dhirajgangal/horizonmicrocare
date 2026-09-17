<?php

namespace App\Livewire\Admin\LoanApplications;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Enums\ApplicationStatus;
use App\Livewire\Admin\AdminComponent;
use App\Models\LoanApplication;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'loan-applications';
    }

    public string $status = '';

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'full_name', 'status', 'created_at'];
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function deleteConfirmed(): void
    {
        LoanApplication::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Archive'));
    }

    public function render(): View
    {
        $applications = LoanApplication::query()
            ->with('loanProduct')
            ->when($this->search, function ($query): void {
                $query->where(function ($nested): void {
                    $nested->where('full_name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('mobile', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->status, fn ($query) => $query->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(15);

        return $this->page('livewire.admin.loan-applications.index', __('Loan applications'), [
            'applications' => $applications,
            'statuses' => ApplicationStatus::cases(),
            'modalRecord' => $this->modalId ? LoanApplication::query()->with('loanProduct')->find($this->modalId) : null,
        ]);
    }
}
