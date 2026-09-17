<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::findOrCreate('Super Admin', 'web');

        $user = User::query()->updateOrCreate(
            ['email' => 'admin@horizonmicrocare.test'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
            ]
        );

        $user->assignRole($role);
    }
}
