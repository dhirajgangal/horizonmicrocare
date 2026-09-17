<?php

namespace App\Services;

use App\Models\SiteSetting;

class SiteSettings
{
    private ?SiteSetting $resolved = null;

    public function current(): SiteSetting
    {
        return $this->resolved ??= SiteSetting::query()->first() ?? $this->fallback();
    }

    public function refresh(): SiteSetting
    {
        $this->resolved = null;

        return $this->current();
    }

    public function adminNotificationEmail(): string
    {
        return $this->current()->admin_notification_email;
    }

    public function consentText(): string
    {
        return $this->current()->consent_text;
    }

    private function fallback(): SiteSetting
    {
        $settings = new SiteSetting([
            'organization_name' => 'Horizonion Microcare Association',
            'tagline' => 'Trust, Growth, Community',
            'phone' => '',
            'email' => 'hello@horizonmicrocare.test',
            'address' => '',
            'hours' => '',
            'seo_title' => 'Horizonion Microcare Association',
            'seo_description' => 'Information and applications for women-focused livelihood loans.',
            'consent_text' => 'I agree to be contacted about this submission. I understand that sending this form does not guarantee a loan, interest rate, or approval.',
            'admin_notification_email' => 'admin@horizonmicrocare.test',
        ]);

        $settings->exists = false;

        return $settings;
    }
}
