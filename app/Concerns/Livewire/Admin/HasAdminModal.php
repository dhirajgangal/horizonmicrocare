<?php

namespace App\Concerns\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;

trait HasAdminModal
{
    #[Url(except: '')]
    public string $modal = '';

    #[Url(except: null)]
    public ?int $modalId = null;

    public function openCreate(): void
    {
        $this->modal = 'create';
        $this->modalId = null;
    }

    public function openEdit(int $id): void
    {
        $this->modal = 'edit';
        $this->modalId = $id;
    }

    public function openView(int $id): void
    {
        $this->modal = 'view';
        $this->modalId = $id;
    }

    public function closeModal(): void
    {
        $this->modal = '';
        $this->modalId = null;
    }

    #[On('record-saved')]
    #[On('close-modal')]
    public function handleModalClosed(): void
    {
        $this->closeModal();
    }

    public function exportUrl(string $format): string
    {
        return route('admin.export', array_filter([
            'module' => $this->exportModule(),
            'format' => $format,
            'search' => $this->search,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
            'status' => $this->status ?? null,
        ], fn (mixed $value): bool => $value !== null && $value !== ''));
    }

    abstract protected function exportModule(): string;
}
