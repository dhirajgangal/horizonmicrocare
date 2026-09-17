<?php

namespace Tests\Feature;

use Database\Seeders\CmsContentSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteSettingSeeder::class);
    }

    public function test_about_page_renders_static_association_content(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('About the association')
            ->assertSee('A community-first institution')
            ->assertSee('Trust, growth, and community')
            ->assertSee('does not guarantee a loan')
            ->assertSee('Horizonion Microcare Association is a women-focused financial inclusion initiative')
            ->assertDontSee('Phase 1 placeholder')
            ->assertDontSee('published from the Super Admin');
    }

    public function test_cms_seeders_do_not_create_an_about_page(): void
    {
        $this->seed(CmsContentSeeder::class);

        $this->assertDatabaseMissing('cms_pages', ['slug' => 'about']);
        $this->assertDatabaseMissing('cms_pages', ['type' => 'about']);
    }
}
