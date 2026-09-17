<?php

namespace Tests\Feature;

use App\Enums\UserStatus;
use App\Filament\Pages\ManageSettings;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_the_admin_panel(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_super_admin_can_open_the_dashboard(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk();
    }

    public function test_inactive_users_cannot_access_the_admin_panel(): void
    {
        $user = $this->makeAdmin();
        $user->forceFill(['status' => UserStatus::Inactive])->save();

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_viewers_cannot_manage_users(): void
    {
        $viewer = $this->makeAdmin('Viewer');

        $this->actingAs($viewer)
            ->get(UserResource::getUrl('index'))
            ->assertForbidden();
    }

    public function test_super_admin_can_open_website_settings(): void
    {
        $this->seed(SiteSettingSeeder::class);

        $admin = $this->makeAdmin();

        $this->actingAs($admin)
            ->get(ManageSettings::getUrl())
            ->assertOk()
            ->assertSee('Horizonion Microcare Association');
    }

    public function test_users_without_a_role_cannot_access_the_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }
}
