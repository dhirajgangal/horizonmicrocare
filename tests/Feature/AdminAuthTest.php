<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_user_without_super_admin_role_cannot_open_the_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_super_admin_can_open_the_dashboard(): void
    {
        $this->siteSettings();
        $admin = $this->superAdmin();

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Horizonion Microcare Association');
    }

    public function test_super_admin_can_sign_in_with_valid_credentials(): void
    {
        $this->siteSettings();
        $this->superAdmin([
            'email' => 'admin@horizonmicrocare.test',
            'password' => 'password',
        ]);

        $this->post(route('admin.login.store'), [
            'email' => 'admin@horizonmicrocare.test',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
    }

    public function test_sidebar_highlights_only_the_current_section(): void
    {
        $this->siteSettings();
        $admin = $this->superAdmin();

        $html = $this->actingAs($admin)
            ->get(route('admin.home-slides.index'))
            ->assertOk()
            ->getContent();

        $this->assertMatchesRegularExpression(
            '/href="'.preg_quote(route('admin.home-slides.index'), '/').'"[^>]*bg-orange/',
            $html,
        );
        $this->assertDoesNotMatchRegularExpression(
            '/href="'.preg_quote(route('admin.dashboard'), '/').'"[^>]*bg-orange/',
            $html,
        );
        $this->assertStringContainsString('storage/images/logo-rectangle.png', $html);
    }
}
