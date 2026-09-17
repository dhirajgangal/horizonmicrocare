<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class LocaleSwitchTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siteSettings();
    }

    public function test_homepage_defaults_to_gujarati_chrome(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee(__('Home'))
            ->assertSee(__('Apply for Loan'));

        $this->assertSame('gu', app()->getLocale());
    }

    public function test_switching_to_english_persists_on_the_next_request(): void
    {
        $this->get(route('locale.switch', 'en'))
            ->assertRedirect();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Home')
            ->assertSee('Apply for Loan');

        $this->assertSame('en', app()->getLocale());
    }
}
