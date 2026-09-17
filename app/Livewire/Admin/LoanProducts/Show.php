<?php

namespace App\Livewire\Admin\LoanProducts;

use App\Livewire\Admin\AdminComponent;
use App\Models\LoanProduct;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public LoanProduct $loanProduct;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.loan-products.show', __('View product'));
    }
}
