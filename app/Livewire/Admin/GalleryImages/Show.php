<?php

namespace App\Livewire\Admin\GalleryImages;

use App\Livewire\Admin\AdminComponent;
use App\Models\GalleryImage;
use Illuminate\Contracts\View\View;

class Show extends AdminComponent
{
    public GalleryImage $galleryImage;

    public bool $embedded = false;

    public function render(): View
    {
        return $this->page('livewire.admin.gallery-images.show', __('View image'));
    }
}
