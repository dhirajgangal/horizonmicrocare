<?php

namespace Tests\Feature;

use App\Models\LoanProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class AdminExportTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    public function test_guest_cannot_export_loan_products(): void
    {
        $this->get(route('admin.export', ['module' => 'loan-products', 'format' => 'csv']))
            ->assertRedirect(route('admin.login'));
    }

    public function test_super_admin_can_download_a_csv_export(): void
    {
        $this->siteSettings();
        $this->actingAs($this->superAdmin());

        LoanProduct::factory()->create(['name' => 'Village Livelihood Loan']);

        $response = $this->get(route('admin.export', ['module' => 'loan-products', 'format' => 'csv']));

        $response->assertOk();
        $this->assertStringContainsString('attachment;', (string) $response->headers->get('content-disposition'));
        $this->assertStringContainsString('Village Livelihood Loan', $response->streamedContent());
    }

    public function test_admin_index_pages_show_a_labeled_export_button(): void
    {
        $this->siteSettings();
        $this->actingAs($this->superAdmin());

        $pages = [
            'loan-applications' => route('admin.loan-applications.index'),
            'inquiries' => route('admin.inquiries.index'),
            'users' => route('admin.users.index'),
            'loan-products' => route('admin.loan-products.index'),
            'faqs' => route('admin.faqs.index'),
            'gallery' => route('admin.gallery.index'),
            'home-slides' => route('admin.home-slides.index'),
            'client-stories' => route('admin.client-stories.index'),
        ];

        foreach ($pages as $module => $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee(__('Export'))
                ->assertSee(route('admin.export', ['module' => $module, 'format' => 'csv'], false), false);
        }
    }

    public function test_csv_export_respects_the_current_search_filter(): void
    {
        $this->siteSettings();
        $this->actingAs($this->superAdmin());

        LoanProduct::factory()->create(['name' => 'Visible Search Loan']);
        LoanProduct::factory()->create(['name' => 'Hidden Other Product']);

        $response = $this->get(route('admin.export', [
            'module' => 'loan-products',
            'format' => 'csv',
            'search' => 'Visible Search',
        ]));

        $response->assertOk();
        $content = $response->streamedContent();
        $this->assertStringContainsString('Visible Search Loan', $content);
        $this->assertStringNotContainsString('Hidden Other Product', $content);
    }
}
