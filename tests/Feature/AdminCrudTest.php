<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Enums\PublishStatus;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Reports;
use App\Filament\Resources\LoanApplications\LoanApplicationResource;
use App\Filament\Resources\LoanProducts\LoanProductResource;
use App\Filament\Resources\LoanProducts\Pages\CreateLoanProduct;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use Database\Seeders\CmsContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_uses_branded_copy(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Empowering Women')
            ->assertSee('Welcome back');
    }

    public function test_super_admin_can_create_a_loan_product(): void
    {
        $admin = $this->makeAdmin();

        Livewire::actingAs($admin)
            ->test(CreateLoanProduct::class)
            ->fillForm([
                'name' => 'Livelihood Support Loan',
                'slug' => 'livelihood-support-loan',
                'summary' => 'Demo product created by test.',
                'status' => PublishStatus::Draft->value,
                'sort_order' => 2,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('loan_products', [
            'slug' => 'livelihood-support-loan',
            'name' => 'Livelihood Support Loan',
        ]);
    }

    public function test_viewer_cannot_create_a_loan_product(): void
    {
        $viewer = $this->makeAdmin('Viewer');

        $this->actingAs($viewer)
            ->get(LoanProductResource::getUrl('create'))
            ->assertForbidden();
    }

    public function test_application_archive_is_a_soft_delete(): void
    {
        $this->seed(CmsContentSeeder::class);
        $admin = $this->makeAdmin();
        $application = LoanApplication::query()->firstOrFail();

        $this->actingAs($admin)
            ->get(LoanApplicationResource::getUrl('index'))
            ->assertOk()
            ->assertSee($application->reference);

        $this->actingAs($admin)
            ->get(LoanApplicationResource::getUrl('view', ['record' => $application]))
            ->assertOk()
            ->assertSee('Details')
            ->assertSee($application->applicant_name)
            ->assertSee('Notes')
            ->assertSee('Documents');

        $application->delete();

        $this->assertSoftDeleted($application);
        $this->assertDatabaseHas('loan_applications', [
            'id' => $application->id,
            'status' => ApplicationStatus::New->value,
        ]);
    }

    public function test_dashboard_and_reports_use_database_counts(): void
    {
        $this->seed(CmsContentSeeder::class);
        $admin = $this->makeAdmin();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Welcome back')
            ->assertSee((string) LoanProduct::query()->count())
            ->assertSee('Recent loan applications')
            ->assertSee('Applications')
            ->assertSee('Inquiries')
            ->assertSee('Loan products')
            ->assertSee('Quick actions');

        $this->actingAs($admin)
            ->get(Reports::getUrl())
            ->assertOk()
            ->assertSee('Reports');
    }

    public function test_login_rejects_invalid_credentials_without_exposing_errors(): void
    {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'nobody@example.test',
                'password' => 'wrong-password',
            ])
            ->call('authenticate')
            ->assertHasFormErrors(['email']);
    }
}
