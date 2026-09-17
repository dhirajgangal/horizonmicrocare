<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DummyDataSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DummyDataSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_dummy_data_seeder_fills_core_admin_modules(): void
    {
        $this->seed([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            DummyDataSeeder::class,
        ]);

        $this->assertGreaterThanOrEqual(4, LoanProduct::query()->count());
        $this->assertGreaterThanOrEqual(10, LoanApplication::query()->count());
        $this->assertGreaterThanOrEqual(6, Inquiry::query()->count());
        $this->assertGreaterThanOrEqual(5, GalleryImage::query()->count());
        $this->assertGreaterThanOrEqual(7, Faq::query()->count());
        $this->assertTrue(User::query()->where('email', 'content@horizonmicrocare.test')->exists());
        $this->assertTrue(User::query()->where('email', 'loans@horizonmicrocare.test')->first()?->hasRole('Loan Manager'));
    }
}
