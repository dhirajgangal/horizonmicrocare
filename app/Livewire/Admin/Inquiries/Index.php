<?php

namespace App\Livewire\Admin\Inquiries;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Enums\InquiryStatus;
use App\Livewire\Admin\AdminComponent;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'inquiries';
    }

    public string $status = '';

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'name', 'status', 'created_at'];
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function deleteConfirmed(): void
    {
        Inquiry::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $inquiries = Inquiry::query()
            ->when($this->search, function ($query): void {
                $query->where(function ($nested): void {
                    $nested->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('subject', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->status, fn ($query) => $query->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(15);

        return $this->page('livewire.admin.inquiries.index', __('Inquiries'), [
            'inquiries' => $inquiries,
            'statuses' => InquiryStatus::cases(),
            'modalRecord' => $this->modalId ? Inquiry::query()->find($this->modalId) : null,
        ]);
    }
}
