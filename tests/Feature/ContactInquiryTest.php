<?php

namespace Tests\Feature;

use App\Enums\InquiryStatus;
use App\Mail\NewInquiryMail;
use App\Models\Inquiry;
use App\Notifications\NewInquiryNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class ContactInquiryTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function validPayload(): array
    {
        return [
            'name' => 'Sonal Gupta',
            'email' => 'sonal@example.test',
            'mobile' => '9876543210',
            'subject' => 'Question about offerings',
            'message' => 'Please tell me how the enquiry process works.',
            'consent' => '1',
            'status' => 'resolved',
            'notes' => 'should be ignored',
        ];
    }

    public function test_valid_enquiry_is_stored_as_new_and_notifies_staff(): void
    {
        Mail::fake();
        Notification::fake();

        $this->siteSettings();
        $admin = $this->superAdmin();

        $this->post(route('contact.store'), $this->validPayload())
            ->assertRedirect(route('contact'));

        $inquiry = Inquiry::query()->first();

        $this->assertNotNull($inquiry);
        $this->assertSame(InquiryStatus::New, $inquiry->status);
        $this->assertNull($inquiry->notes);
        $this->assertSame('Sonal Gupta', $inquiry->name);

        Mail::assertQueued(NewInquiryMail::class);
        Notification::assertSentTo($admin, NewInquiryNotification::class);
    }

    public function test_honeypot_enquiry_is_discarded(): void
    {
        Mail::fake();
        $this->siteSettings();

        $this->post(route('contact.store'), [
            ...$this->validPayload(),
            'website' => 'bot',
        ])->assertRedirect(route('contact'));

        $this->assertDatabaseCount('inquiries', 0);
        Mail::assertNothingQueued();
    }
}
