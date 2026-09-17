<?php

namespace App\Livewire\Admin\ClientStories;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Livewire\Admin\AdminComponent;
use App\Models\ClientStory;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'client-stories';
    }

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'name', 'is_published', 'sort_order', 'created_at'];
    }

    public function deleteConfirmed(): void
    {
        ClientStory::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $stories = ClientStory::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(12);

        return $this->page('livewire.admin.client-stories.index', __('Client stories'), [
            'stories' => $stories,
            'modalRecord' => $this->modalId ? ClientStory::query()->find($this->modalId) : null,
        ]);
    }
}
