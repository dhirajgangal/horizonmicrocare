<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'organization_name' => 'Horizonion Microcare Association',
                'tagline' => 'Trust, Growth, Community',
                'phone' => '022 4000 1200',
                'email' => 'hello@horizonmicrocare.test',
                'address' => "Horizonion Microcare Association\nMumbai, Maharashtra",
                'hours' => 'Monday–Friday, 10:00–17:00',
                'facebook_url' => 'https://www.facebook.com',
                'instagram_url' => 'https://www.instagram.com',
                'twitter_url' => null,
                'youtube_url' => null,
                'linkedin_url' => 'https://www.linkedin.com',
                'seo_title' => 'Horizonion Microcare Association',
                'seo_description' => 'Women-focused livelihood loan information and applications. Submitting a form never guarantees a loan or approval.',
                'consent_text' => 'I agree to be contacted about this submission. I understand that sending this form does not guarantee a loan, interest rate, or approval.',
                'admin_notification_email' => 'admin@horizonmicrocare.test',
                'ceo_name' => 'Anjali Mehra',
                'ceo_designation' => 'Chief Executive Officer',
                'ceo_photo' => 'images/clients/client-04.jpg',
                'ceo_bio' => "We started Horizonion Microcare Association so women could ask for livelihood support without being promised an outcome they had not been offered.\n\nThis website collects information and applications. The conversation that follows — if it follows — is always a review, never an automatic yes.",
            ]
        );
    }
}
