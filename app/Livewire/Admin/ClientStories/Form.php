<?php

namespace App\Livewire\Admin\ClientStories;

use App\Concerns\Livewire\Admin\FinishesAdminSave;
use App\Livewire\Admin\AdminComponent;
use App\Models\ClientStory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends AdminComponent
{
    use FinishesAdminSave;
    use WithFileUploads;

    public ?int $storyId = null;

    public string $name = '';

    public string $slug = '';

    public string $feedback = '';

    public string $location = '';

    public bool $is_published = false;

    public int $sort_order = 0;

    public $photo = null;

    public ?string $existingPhoto = null;

    public function mount(?ClientStory $clientStory = null): void
    {
        if (! $clientStory?->exists) {
            return;
        }

        $this->storyId = $clientStory->id;
        $this->name = $clientStory->name;
        $this->slug = (string) $clientStory->slug;
        $this->feedback = $clientStory->feedback;
        $this->location = (string) $clientStory->location;
        $this->is_published = $clientStory->is_published;
        $this->sort_order = $clientStory->sort_order;
        $this->existingPhoto = $clientStory->photo;
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('client_stories', 'slug')->ignore($this->storyId)],
            'feedback' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:160'],
            'is_published' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'photo' => [$this->storyId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $data = $this->only(['name', 'slug', 'feedback', 'location', 'is_published', 'sort_order']);

        if ($this->photo instanceof TemporaryUploadedFile) {
            $data['photo'] = $this->photo->store('images/clients', 'public');
        }

        ClientStory::query()->updateOrCreate(['id' => $this->storyId], $data);

        $this->finishSave($this->storyId ? __('Updated') : __('Saved'), 'admin.client-stories.index');
    }

    public function render(): View
    {
        return $this->page('livewire.admin.client-stories.form', $this->storyId ? 'Edit story' : 'Create story');
    }
}
