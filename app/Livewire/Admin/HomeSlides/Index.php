<?php

namespace App\Livewire\Admin\HomeSlides;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Livewire\Admin\AdminComponent;
use App\Models\HomeSlide;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'home-slides';
    }

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'heading', 'sort_order', 'is_active', 'created_at'];
    }

    public function deleteConfirmed(): void
    {
        HomeSlide::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $slides = HomeSlide::query()
            ->when($this->search, fn ($query) => $query->where('heading', 'like', '%'.$this->search.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(12);

        return $this->page('livewire.admin.home-slides.index', __('Home slides'), [
            'slides' => $slides,
            'modalRecord' => $this->modalId ? HomeSlide::query()->find($this->modalId) : null,
        ]);
    }
}
