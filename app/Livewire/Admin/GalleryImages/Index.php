<?php

namespace App\Livewire\Admin\GalleryImages;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Livewire\Admin\AdminComponent;
use App\Models\GalleryImage;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'gallery';
    }

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'label', 'is_active', 'sort_order', 'created_at'];
    }

    public function deleteConfirmed(): void
    {
        GalleryImage::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $images = GalleryImage::query()
            ->when($this->search, fn ($query) => $query->where('label', 'like', '%'.$this->search.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(12);

        return $this->page('livewire.admin.gallery-images.index', __('Gallery'), [
            'images' => $images,
            'modalRecord' => $this->modalId ? GalleryImage::query()->find($this->modalId) : null,
        ]);
    }
}
