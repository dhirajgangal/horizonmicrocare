<?php

namespace App\Livewire\Admin\LoanProducts;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Livewire\Admin\AdminComponent;
use App\Models\LoanProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Form extends AdminComponent
{
    use FinishesAdminSave;

    public ?int $productId = null;

    public string $name = '';

    public string $slug = '';

    public string $short_description = '';

    public string $description = '';

    public string $featuresText = '';

    public string $eligibility = '';

    public string $required_documents = '';

    public bool $is_active = true;

    public int $sort_order = 0;

    public function mount(?LoanProduct $loanProduct = null): void
    {
        if (! $loanProduct?->exists) {
            return;
        }

        $this->productId = $loanProduct->id;
        $this->fill($loanProduct->only(['name', 'slug', 'short_description', 'description', 'eligibility', 'required_documents', 'is_active', 'sort_order']));
        $this->featuresText = implode("\n", $loanProduct->features ?? []);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('loan_products', 'slug')->ignore($this->productId)],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'featuresText' => ['nullable', 'string'],
            'eligibility' => ['nullable', 'string'],
            'required_documents' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        LoanProduct::query()->updateOrCreate(
            ['id' => $this->productId],
            [
                ...collect($data)->except('featuresText')->all(),
                'features' => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->featuresText) ?: []))),
            ]
        );

        $this->finishSave($this->productId ? __('Updated') : __('Saved'), 'admin.loan-products.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.loan-products.form', $this->productId ? __('Edit product') : __('Create product'));
    }
}
