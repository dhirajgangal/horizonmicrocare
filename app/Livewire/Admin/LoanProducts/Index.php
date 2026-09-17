<?php

namespace App\Livewire\Admin\LoanProducts;

use App\Concerns\Livewire\Admin\HasAdminList;
use App\Concerns\Livewire\Admin\HasAdminModal;
use App\Livewire\Admin\AdminComponent;
use App\Models\LoanProduct;
use Illuminate\Contracts\View\View;

class Index extends AdminComponent
{
    use HasAdminList;
    use HasAdminModal;

    protected function exportModule(): string
    {
        return 'loan-products';
    }

    /**
     * @return list<string>
     */
    protected function sortable(): array
    {
        return ['id', 'name', 'sort_order', 'is_active', 'created_at'];
    }

    public function deleteConfirmed(): void
    {
        LoanProduct::query()->findOrFail($this->deletingId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', type: 'success', message: __('Deleted'));
    }

    public function render(): View
    {
        $products = LoanProduct::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id')
            ->paginate(12);

        return $this->page('livewire.admin.loan-products.index', __('Loan products'), [
            'products' => $products,
            'modalRecord' => $this->modalId ? LoanProduct::query()->find($this->modalId) : null,
        ]);
    }
}
