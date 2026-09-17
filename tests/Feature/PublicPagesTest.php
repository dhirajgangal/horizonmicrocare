<?php

namespace Tests\Feature;

use App\Models\ClientStory;
use App\Models\LoanProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siteSettings();
    }

    public function test_home_page_renders_association_name(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Horizonion Microcare Association')
            ->assertDontSee('Laravel');
    }

    public function test_static_and_listing_pages_return_successful_responses(): void
    {
        foreach ([
            route('about'),
            route('mission'),
            route('offerings.index'),
            route('stories.index'),
            route('gallery'),
            route('faqs'),
            route('apply'),
            route('contact'),
            route('privacy'),
            route('terms'),
            route('disclaimer'),
            route('responsible-lending'),
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_active_offering_page_renders_and_inactive_offering_returns_404(): void
    {
        $active = LoanProduct::factory()->create(['name' => 'Visible Livelihood Loan']);
        $hidden = LoanProduct::factory()->inactive()->create(['name' => 'Hidden Livelihood Loan']);

        $this->get(route('offerings.show', $active))
            ->assertOk()
            ->assertSee('Visible Livelihood Loan');

        $this->get(route('offerings.show', $hidden))->assertNotFound();
        $this->get(route('offerings.index'))->assertDontSee('Hidden Livelihood Loan');
    }

    public function test_published_story_page_renders_and_unpublished_story_returns_404(): void
    {
        $published = ClientStory::factory()->create(['name' => 'Published Woman']);
        $draft = ClientStory::factory()->unpublished()->create(['name' => 'Draft Woman']);

        $this->get(route('stories.show', $published))
            ->assertOk()
            ->assertSee('Published Woman');

        $this->get(route('stories.show', $draft))->assertNotFound();
    }
}
