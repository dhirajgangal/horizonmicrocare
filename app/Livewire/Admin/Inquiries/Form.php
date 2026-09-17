<?php

namespace App\Livewire\Admin\Inquiries;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Enums\InquiryStatus;
use App\Livewire\Admin\AdminComponent;
use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Form extends AdminComponent
{
    use FinishesAdminSave;

    public Inquiry $inquiry;

    public string $status;

    public string $notes = '';

    public function mount(Inquiry $inquiry): void
    {
        $this->inquiry = $inquiry;
        $this->status = $inquiry->status->value;
        $this->notes = (string) $inquiry->notes;
    }

    public function save(): void
    {
        $data = $this->validate([
            'status' => ['required', Rule::enum(InquiryStatus::class)],
            'notes' => ['nullable', 'string'],
        ]);

        $this->inquiry->update($data);

        $this->finishSave(__('Updated'), 'admin.inquiries.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.inquiries.form', 'Update enquiry');
    }
}
