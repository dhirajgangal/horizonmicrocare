<?php

namespace Tests\Feature;

use App\Services\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_can_be_stored_and_read(): void
    {
        $settings = app(SiteSettings::class);

        $settings->set('general.company_name', 'Updated Microcare Association');

        $this->assertSame('Updated Microcare Association', $settings->get('general.company_name'));
    }

    public function test_the_public_site_uses_the_configured_company_name(): void
    {
        $settings = app(SiteSettings::class);
        $settings->set('general.company_name', 'Updated Microcare Association');

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Updated Microcare Association');
    }

    public function test_defaults_are_available_before_seeding(): void
    {
        $settings = app(SiteSettings::class);

        $this->assertSame('Horizonion Microcare Association', $settings->get('general.company_name'));
        $this->assertNotEmpty($settings->get('consent.text'));
    }
}
