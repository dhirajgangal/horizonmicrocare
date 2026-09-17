<?php

namespace App\Livewire\Admin\Faqs;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Livewire\Admin\AdminComponent;
use App\Models\Faq;
use Illuminate\Contracts\View\View;

class Form extends AdminComponent
{
    use FinishesAdminSave;

    public ?int $faqId = null;

    public string $question = '';

    public string $answer = '';

    public string $category = '';

    public bool $is_active = true;

    public bool $is_featured = false;

    public int $sort_order = 0;

    public function mount(?Faq $faq = null): void
    {
        if (! $faq?->exists) {
            return;
        }

        $this->faqId = $faq->id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->category = (string) $faq->category;
        $this->is_active = $faq->is_active;
        $this->is_featured = $faq->is_featured;
        $this->sort_order = $faq->sort_order;
    }

    public function save(): void
    {
        $data = $this->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:80'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        Faq::query()->updateOrCreate(['id' => $this->faqId], $data);

        $this->finishSave($this->faqId ? __('Updated') : __('Saved'), 'admin.faqs.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.faqs.form', $this->faqId ? __('Edit FAQ') : __('Create FAQ'));
    }
}
