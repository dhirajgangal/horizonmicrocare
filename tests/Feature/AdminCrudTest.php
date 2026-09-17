<?php

namespace Tests\Feature;

use App\Livewire\Admin\Faqs\Form as FaqForm;
use App\Livewire\Admin\Faqs\Index as FaqIndex;
use App\Livewire\Admin\LoanProducts\Form as ProductForm;
use App\Livewire\Admin\LoanProducts\Index as ProductIndex;
use App\Models\Faq;
use App\Models\LoanProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siteSettings();
        $this->actingAs($this->superAdmin());
    }

    public function test_guest_cannot_open_product_index(): void
    {
        auth()->logout();

        $this->get(route('admin.loan-products.index'))->assertRedirect(route('admin.login'));
    }

    public function test_super_admin_can_create_a_loan_product(): void
    {
        Livewire::test(ProductForm::class)
            ->set('name', 'Community Livelihood Loan')
            ->set('short_description', 'A product for enquiry only.')
            ->set('description', 'Full description of the offering.')
            ->set('featuresText', "Feature one\nFeature two")
            ->set('is_active', true)
            ->set('sort_order', 1)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('loan_products', [
            'name' => 'Community Livelihood Loan',
            'is_active' => true,
        ]);
    }

    public function test_super_admin_can_update_and_delete_a_loan_product(): void
    {
        $product = LoanProduct::factory()->create(['name' => 'Old Name']);

        Livewire::test(ProductForm::class, ['loanProduct' => $product])
            ->set('name', 'Updated Name')
            ->set('short_description', $product->short_description)
            ->set('description', $product->description)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('loan_products', [
            'id' => $product->id,
            'name' => 'Updated Name',
        ]);

        Livewire::test(ProductIndex::class)
            ->call('confirmDelete', $product->id)
            ->call('deleteConfirmed');

        $this->assertDatabaseMissing('loan_products', ['id' => $product->id]);
    }

    public function test_super_admin_can_create_and_delete_a_faq(): void
    {
        Livewire::test(FaqForm::class)
            ->set('question', 'Does the website approve loans?')
            ->set('answer', 'No. The website never approves a loan.')
            ->set('category', 'General')
            ->set('is_active', true)
            ->set('is_featured', true)
            ->set('sort_order', 1)
            ->call('save')
            ->assertHasNoErrors();

        $faq = Faq::query()->first();
        $this->assertNotNull($faq);

        Livewire::test(FaqIndex::class)
            ->call('confirmDelete', $faq->id)
            ->call('deleteConfirmed');

        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
    }

    public function test_admin_module_index_pages_render(): void
    {
        foreach ([
            route('admin.home-slides.index'),
            route('admin.loan-products.index'),
            route('admin.client-stories.index'),
            route('admin.gallery.index'),
            route('admin.faqs.index'),
            route('admin.loan-applications.index'),
            route('admin.inquiries.index'),
            route('admin.settings.edit'),
            route('admin.users.index'),
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }
}
