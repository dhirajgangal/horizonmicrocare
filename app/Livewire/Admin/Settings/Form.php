<?php

namespace App\Livewire\Admin\Settings;

use App\Livewire\Admin\AdminComponent;
use App\Models\SiteSetting;
use App\Services\SiteSettings;
use App\Support\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends AdminComponent
{
    use WithFileUploads;

    public string $organization_name = '';

    public string $tagline = '';

    public string $phone = '';

    public string $email = '';

    public string $address = '';

    public string $hours = '';

    public string $facebook_url = '';

    public string $instagram_url = '';

    public string $twitter_url = '';

    public string $youtube_url = '';

    public string $linkedin_url = '';

    public string $seo_title = '';

    public string $seo_description = '';

    public string $consent_text = '';

    public string $admin_notification_email = '';

    public string $ceo_name = '';

    public string $ceo_designation = '';

    public string $ceo_bio = '';

    public $ceo_photo = null;

    public ?string $existingCeoPhoto = null;

    public function mount(SiteSettings $settings): void
    {
        $current = $settings->current();
        $this->organization_name = (string) $current->organization_name;
        $this->tagline = (string) $current->tagline;
        $this->phone = (string) $current->phone;
        $this->email = (string) $current->email;
        $this->address = (string) $current->address;
        $this->hours = (string) $current->hours;
        $this->facebook_url = (string) $current->facebook_url;
        $this->instagram_url = (string) $current->instagram_url;
        $this->twitter_url = (string) $current->twitter_url;
        $this->youtube_url = (string) $current->youtube_url;
        $this->linkedin_url = (string) $current->linkedin_url;
        $this->seo_title = (string) $current->seo_title;
        $this->seo_description = (string) $current->seo_description;
        $this->consent_text = (string) $current->consent_text;
        $this->admin_notification_email = (string) $current->admin_notification_email;
        $this->ceo_name = (string) $current->ceo_name;
        $this->ceo_designation = (string) $current->ceo_designation;
        $this->ceo_bio = (string) $current->ceo_bio;
        $this->existingCeoPhoto = $current->ceo_photo;
    }

    public function save(SiteSettings $settings): void
    {
        $data = $this->validate([
            'organization_name' => ['required', 'string', 'max:160'],
            'tagline' => ['required', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'hours' => ['nullable', 'string', 'max:160'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:160'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'consent_text' => ['required', 'string'],
            'admin_notification_email' => ['required', 'email', 'max:255'],
            'ceo_name' => ['nullable', 'string', 'max:120'],
            'ceo_designation' => ['nullable', 'string', 'max:160'],
            'ceo_bio' => ['nullable', 'string'],
            'ceo_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        unset($data['ceo_photo']);

        if ($this->ceo_photo instanceof TemporaryUploadedFile) {
            $data['ceo_photo'] = $this->ceo_photo->store('images/ceo', 'public');
        }

        $record = SiteSetting::query()->first() ?? new SiteSetting;
        $record->fill($data);
        $record->save();

        $settings->refresh();
        $this->existingCeoPhoto = $record->ceo_photo;

        Toast::success('Updated');
        $this->redirect(route('admin.settings.edit'), navigate: true);
    }

    public function render(): View
    {
        return $this->page('livewire.admin.settings.form', __('Settings'));
    }
}
