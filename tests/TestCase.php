<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function seedRoles(): void
    {
        $this->seed(RolePermissionSeeder::class);
    }

    protected function makeAdmin(string $role = 'Super Admin'): User
    {
        $this->seedRoles();

        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }
}
