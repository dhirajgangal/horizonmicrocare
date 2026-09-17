<?php

namespace App\Livewire\Admin\GalleryImages;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Livewire\Admin\AdminComponent;
use App\Models\GalleryImage;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends AdminComponent
{
    use FinishesAdminSave;
    use WithFileUploads;

    public ?int $imageId = null;

    public string $label = '';

    public string $alt_text = '';

    public bool $is_active = true;

    public int $sort_order = 0;

    public $image = null;

    public ?string $existingImage = null;

    public function mount(?GalleryImage $galleryImage = null): void
    {
        if (! $galleryImage?->exists) {
            return;
        }

        $this->imageId = $galleryImage->id;
        $this->fill($galleryImage->only(['label', 'alt_text', 'is_active', 'sort_order']));
        $this->existingImage = $galleryImage->image;
    }

    public function save(): void
    {
        $this->validate([
            'label' => ['required', 'string', 'max:160'],
            'alt_text' => ['required', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'image' => [$this->imageId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ]);

        $data = $this->only(['label', 'alt_text', 'is_active', 'sort_order']);

        if ($this->image instanceof TemporaryUploadedFile) {
            $data['image'] = $this->image->store('images/gallery', 'public');
        }

        GalleryImage::query()->updateOrCreate(['id' => $this->imageId], $data);

        $this->finishSave($this->imageId ? __('Updated') : __('Saved'), 'admin.gallery.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.gallery-images.form', $this->imageId ? __('Edit image') : __('Create image'));
    }
}
