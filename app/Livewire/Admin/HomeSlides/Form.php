<?php

namespace App\Livewire\Admin\HomeSlides;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Livewire\Admin\AdminComponent;
use App\Models\HomeSlide;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends AdminComponent
{
    use FinishesAdminSave;
    use WithFileUploads;

    public ?int $slideId = null;

    public string $kicker = '';

    public string $heading = '';

    public string $text = '';

    public string $cta_label = '';

    public string $cta_url = '';

    public bool $is_active = true;

    public int $sort_order = 0;

    public $image = null;

    public ?string $existingImage = null;

    public function mount(?HomeSlide $homeSlide = null): void
    {
        if (! $homeSlide?->exists) {
            return;
        }

        $this->slideId = $homeSlide->id;
        $this->kicker = (string) $homeSlide->kicker;
        $this->heading = $homeSlide->heading;
        $this->text = (string) $homeSlide->text;
        $this->cta_label = (string) $homeSlide->cta_label;
        $this->cta_url = (string) $homeSlide->cta_url;
        $this->is_active = $homeSlide->is_active;
        $this->sort_order = $homeSlide->sort_order;
        $this->existingImage = $homeSlide->image;
    }

    public function save(): void
    {
        $rules = [
            'kicker' => ['nullable', 'string', 'max:120'],
            'heading' => ['required', 'string', 'max:180'],
            'text' => ['nullable', 'string', 'max:500'],
            'cta_label' => ['nullable', 'string', 'max:60'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'image' => [$this->slideId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];

        $this->validate($rules);

        $data = $this->only(['kicker', 'heading', 'text', 'cta_label', 'cta_url', 'is_active', 'sort_order']);

        if ($this->image instanceof TemporaryUploadedFile) {
            $data['image'] = $this->image->store('images/carousel', 'public');
        }

        HomeSlide::query()->updateOrCreate(['id' => $this->slideId], $data);

        $this->finishSave($this->slideId ? __('Updated') : __('Saved'), 'admin.home-slides.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.home-slides.form', $this->slideId ? __('Edit slide') : __('Create slide'));
    }
}
