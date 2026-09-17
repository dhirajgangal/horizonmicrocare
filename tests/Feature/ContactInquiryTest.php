<?php

namespace Tests\Feature;

use App\Enums\InquiryStatus;
use App\Models\Inquiry;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactInquiryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteSettingSeeder::class);
    }

    public function test_contact_page_renders_office_details_and_enquiry_form(): void
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Contact us')
            ->assertSee('Send an enquiry')
            ->assertSee('Send enquiry')
            ->assertSee('Apply for a Loan')
            ->assertSee('does not guarantee a loan')
            ->assertSee('+91 20 4000 1200')
            ->assertSee('hello@horizonmicrocare.test')
            ->assertSee('name="name"', false)
            ->assertSee('name="message"', false);
    }

    public function test_valid_enquiry_is_stored_and_redirects_with_success(): void
    {
        $response = $this->from(route('contact'))->post(route('inquiries.store'), [
            'name' => 'Priya Kulkarni',
            'email' => 'priya.kulkarni@example.test',
            'mobile' => '9876502001',
            'subject' => 'Need eligibility details',
            'message' => 'Please share the current eligibility steps for a livelihood loan.',
            'consent' => '1',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Priya Kulkarni',
            'email' => 'priya.kulkarni@example.test',
            'mobile' => '9876502001',
            'subject' => 'Need eligibility details',
            'status' => InquiryStatus::New->value,
        ]);
    }

    public function test_empty_enquiry_is_rejected_and_does_not_create_a_record(): void
    {
        $response = $this->from(route('contact'))->post(route('inquiries.store'), []);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHasErrors(['name', 'email', 'message', 'consent']);

        $this->assertSame(0, Inquiry::query()->count());
    }

    public function test_public_enquiry_cannot_set_status_or_internal_notes(): void
    {
        $this->from(route('contact'))->post(route('inquiries.store'), [
            'name' => 'Priya Kulkarni',
            'email' => 'priya.kulkarni@example.test',
            'message' => 'Please share office hours.',
            'consent' => '1',
            'status' => InquiryStatus::Resolved->value,
            'internal_notes' => 'Attempted override',
        ])->assertRedirect(route('contact'));

        $inquiry = Inquiry::query()->firstOrFail();

        $this->assertSame(InquiryStatus::New, $inquiry->status);
        $this->assertNull($inquiry->internal_notes);
    }

    public function test_filled_honeypot_does_not_create_an_enquiry(): void
    {
        $this->from(route('contact'))->post(route('inquiries.store'), [
            'name' => 'Bot User',
            'email' => 'bot@example.test',
            'message' => 'Spam message',
            'consent' => '1',
            'website' => 'https://spam.example',
        ])->assertRedirect(route('contact'));

        $this->assertSame(0, Inquiry::query()->count());
    }
}
