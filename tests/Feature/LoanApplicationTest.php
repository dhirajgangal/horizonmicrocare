<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Mail\NewLoanApplicationMail;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Notifications\NewLoanApplicationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class LoanApplicationTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function validPayload(LoanProduct $product): array
    {
        return [
            'loan_product_id' => $product->id,
            'requested_amount' => 25000,
            'purpose' => 'Stock for a tailoring shop',
            'full_name' => 'Kavita Joshi',
            'mobile' => '9876543210',
            'email' => 'kavita@example.test',
            'gender' => 'Woman',
            'date_of_birth' => now()->subYears(28)->toDateString(),
            'state' => 'Maharashtra',
            'district' => 'Pune',
            'pincode' => '411001',
            'address' => '12 Market Street',
            'occupation' => 'Tailor',
            'monthly_income' => '10000-25000',
            'marital_status' => 'Married',
            'consent' => '1',
            'status' => 'accepted',
            'internal_notes' => 'should be ignored',
        ];
    }

    public function test_valid_application_is_stored_as_new_and_notifies_staff(): void
    {
        Mail::fake();
        Notification::fake();

        $this->siteSettings();
        $admin = $this->superAdmin();
        $product = LoanProduct::factory()->create();

        $this->post(route('apply.store'), $this->validPayload($product))
            ->assertRedirect(route('apply'));

        $application = LoanApplication::query()->first();

        $this->assertNotNull($application);
        $this->assertSame(ApplicationStatus::New, $application->status);
        $this->assertNull($application->internal_notes);
        $this->assertSame('Kavita Joshi', $application->full_name);

        Mail::assertQueued(NewLoanApplicationMail::class);
        Notification::assertSentTo($admin, NewLoanApplicationNotification::class);
    }

    public function test_honeypot_submission_does_not_store_an_application(): void
    {
        Mail::fake();
        $this->siteSettings();
        $product = LoanProduct::factory()->create();

        $this->post(route('apply.store'), [
            ...$this->validPayload($product),
            'website' => 'https://spam.test',
        ])->assertRedirect(route('apply'));

        $this->assertDatabaseCount('loan_applications', 0);
        Mail::assertNothingQueued();
    }

    public function test_application_without_consent_is_rejected(): void
    {
        $this->siteSettings();
        $product = LoanProduct::factory()->create();
        $payload = $this->validPayload($product);
        unset($payload['consent']);

        $this->from(route('apply'))
            ->post(route('apply.store'), $payload)
            ->assertSessionHasErrors('consent');

        $this->assertDatabaseCount('loan_applications', 0);
    }
}
