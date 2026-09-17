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

    public function test_gujarati_locale_translates_public_and_admin_form_labels(): void
    {
        $this->get(route('apply'))
            ->assertOk()
            ->assertSee('પૂરું નામ')
            ->assertSee('લોન પ્રોડક્ટ')
            ->assertSee('અરજી મોકલો')
            ->assertDontSee('Full name')
            ->assertDontSee('Loan product')
            ->assertDontSee('Submit application');

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('સંદેશ')
            ->assertSee('પૂછપરછ મોકલો')
            ->assertDontSee('Send enquiry');

        $this->actingAs($this->superAdmin())
            ->get(route('admin.settings.edit'))
            ->assertOk()
            ->assertSee('સંસ્થા નું નામ')
            ->assertSee('ટેગલાઇન')
            ->assertDontSee('Organisation name');
    }

    public function test_english_locale_keeps_public_and_admin_form_labels_in_english(): void
    {
        $this->get(route('locale.switch', 'en'))->assertRedirect();

        $this->get(route('apply'))
            ->assertOk()
            ->assertSee('Full name')
            ->assertSee('Loan product')
            ->assertSee('Submit application')
            ->assertDontSee('પૂરું નામ');

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Send enquiry')
            ->assertDontSee('પૂછપરછ મોકલો');

        $this->actingAs($this->superAdmin())
            ->get(route('admin.settings.edit'))
            ->assertOk()
            ->assertSee('Organisation name')
            ->assertSee('Tagline')
            ->assertDontSee('સંસ્થા નું નામ');
    }
}
