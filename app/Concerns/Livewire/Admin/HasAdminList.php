<?php

namespace App\Concerns\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\WithPagination;

trait HasAdminList
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    public bool $confirmingDeletion = false;

    public ?int $deletingId = null;

    /**
     * @return list<string>
     */
    abstract protected function sortable(): array;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if (! in_array($field, $this->sortable(), true)) {
            return;
        }

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';

            return;
        }

        $this->sortField = $field;
        $this->sortDirection = 'asc';
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->confirmingDeletion = true;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }
}
