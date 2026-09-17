<?php

namespace Tests\Feature;

use Database\Seeders\CmsContentSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MissionPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteSettingSeeder::class);
    }

    public function test_mission_page_renders_static_mission_vision_and_values(): void
    {
        $this->get(route('mission'))
            ->assertOk()
            ->assertSee('Mission, vision, values')
            ->assertSee('Help women access responsible financial information')
            ->assertSee('Communities that can trust the process')
            ->assertSee('Trust, growth, and community')
            ->assertSee('does not guarantee a loan')
            ->assertDontSee('Phase 1 placeholder')
            ->assertDontSee('managed from the CMS');
    }

    public function test_cms_seeders_do_not_create_mission_vision_or_values_pages(): void
    {
        $this->seed(CmsContentSeeder::class);

        $this->assertDatabaseMissing('cms_pages', ['slug' => 'mission']);
        $this->assertDatabaseMissing('cms_pages', ['slug' => 'vision']);
        $this->assertDatabaseMissing('cms_pages', ['slug' => 'values']);
        $this->assertDatabaseMissing('cms_pages', ['type' => 'mission']);
        $this->assertDatabaseMissing('cms_pages', ['type' => 'vision']);
        $this->assertDatabaseMissing('cms_pages', ['type' => 'values']);
    }
}
