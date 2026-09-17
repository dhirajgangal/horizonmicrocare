<?php

namespace App\Models;

use App\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'organization_name',
    'tagline',
    'phone',
    'email',
    'address',
    'hours',
    'facebook_url',
    'instagram_url',
    'twitter_url',
    'youtube_url',
    'linkedin_url',
    'seo_title',
    'seo_description',
    'consent_text',
    'admin_notification_email',
    'ceo_name',
    'ceo_designation',
    'ceo_photo',
    'ceo_bio',
])]
class SiteSetting extends Model
{
    use LogsModelActivity;

    public function ceoPhotoUrl(): ?string
    {
        if (! filled($this->ceo_photo)) {
            return null;
        }

        return Storage::disk('public')->url($this->ceo_photo);
    }

    /**
     * @return array<string, string>
     */
    public function socialLinks(): array
    {
        return array_filter([
            'Facebook' => $this->facebook_url,
            'Instagram' => $this->instagram_url,
            'X' => $this->twitter_url,
            'YouTube' => $this->youtube_url,
            'LinkedIn' => $this->linkedin_url,
        ], fn (?string $url) => filled($url));
    }
}
