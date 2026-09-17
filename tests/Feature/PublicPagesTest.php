<?php

namespace Tests\Feature;

use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteSettingSeeder::class);
    }

    public function test_the_home_page_renders(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Horizonion Microcare')
            ->assertSee('Apply for Loan');
    }

    public function test_primary_public_pages_render(): void
    {
        $routes = [
            'about',
            'mission',
            'loans.index',
            'how-it-works',
            'eligibility',
            'responsible-lending',
            'stories.index',
            'gallery',
            'faqs',
            'apply',
            'track',
            'contact',
            'grievance',
            'careers',
            'news',
            'resources',
            'privacy',
            'terms',
            'disclaimer',
        ];

        foreach ($routes as $route) {
            $this->get(route($route))->assertOk();
        }
    }

    public function test_dynamic_placeholder_pages_render(): void
    {
        $this->get(route('loans.show', 'income-generation-loan'))
            ->assertOk()
            ->assertSee('income-generation-loan');

        $this->get(route('stories.show', 'demo-story'))
            ->assertOk()
            ->assertSee('demo-story');
    }
}
