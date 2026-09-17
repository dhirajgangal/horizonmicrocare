<?php

namespace Tests\Feature;

use App\Livewire\Admin\Profile\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\Concerns\CreatesAdminData;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use CreatesAdminData, RefreshDatabase;

    public function test_guest_is_redirected_from_profile(): void
    {
        $this->get(route('admin.profile.edit'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_super_admin_can_update_name_with_current_password(): void
    {
        $this->siteSettings();
        $admin = $this->superAdmin([
            'name' => 'Original Admin',
            'password' => 'password',
        ]);

        $this->actingAs($admin);

        Livewire::test(Form::class)
            ->set('name', 'Updated Admin')
            ->set('current_password', 'password')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('Updated Admin', $admin->fresh()->name);
        $this->assertTrue(Hash::check('password', $admin->fresh()->password));
    }

    public function test_profile_rejects_an_incorrect_current_password(): void
    {
        $this->siteSettings();
        $admin = $this->superAdmin(['password' => 'password']);

        $this->actingAs($admin);

        Livewire::test(Form::class)
            ->set('name', 'Hacker')
            ->set('current_password', 'wrong-password')
            ->call('save')
            ->assertHasErrors(['current_password']);

        $this->assertNotSame('Hacker', $admin->fresh()->name);
    }
}
