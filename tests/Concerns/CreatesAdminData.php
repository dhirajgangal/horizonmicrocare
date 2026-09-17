<?php

namespace Tests\Concerns;

use App\Models\SiteSetting;
use App\Models\User;
use Spatie\Permission\Models\Role;

trait CreatesAdminData
{
    protected function superAdmin(array $overrides = []): User
    {
        $role = Role::findOrCreate('Super Admin', 'web');

        $user = User::factory()->create(array_merge([
            'email' => 'admin@horizonmicrocare.test',
        ], $overrides));

        $user->assignRole($role);

        return $user;
    }

    protected function siteSettings(): SiteSetting
    {
        return SiteSetting::query()->create([
            'organization_name' => 'Horizonion Microcare Association',
            'tagline' => 'Trust, Growth, Community',
            'phone' => '022 4000 1200',
            'email' => 'hello@horizonmicrocare.test',
            'address' => 'Mumbai',
            'hours' => '10:00–17:00',
            'seo_title' => 'Horizonion Microcare Association',
            'seo_description' => 'Women-focused livelihood loan information.',
            'consent_text' => 'I agree to be contacted. This form does not guarantee a loan or approval.',
            'admin_notification_email' => 'admin@horizonmicrocare.test',
            'ceo_name' => 'Anjali Mehra',
            'ceo_designation' => 'Chief Executive Officer',
            'ceo_bio' => 'Leadership note.',
        ]);
    }
}
