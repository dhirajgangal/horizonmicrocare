<?php

namespace App\Livewire\Admin\Faqs;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Livewire\Admin\AdminComponent;
use App\Models\Faq;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'faqs';
    }

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'question', 'category', 'is_active', 'is_featured', 'sort_order'];
    }

    public function deleteConfirmed(): void
    {
        Faq::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $faqs = Faq::query()
            ->when($this->search, fn ($query) => $query->where('question', 'like', '%'.$this->search.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(12);

        return $this->page('livewire.admin.faqs.index', __('FAQs'), [
            'faqs' => $faqs,
            'modalRecord' => $this->modalId ? Faq::query()->find($this->modalId) : null,
        ]);
    }
}
