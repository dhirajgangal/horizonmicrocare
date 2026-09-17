<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'cms.manage',
            'settings.manage',
            'navigation.manage',
            'loans.view',
            'loans.create',
            'loans.edit',
            'loans.delete',
            'applications.view',
            'applications.update',
            'applications.export',
            'inquiries.view',
            'inquiries.update',
            'inquiries.export',
            'stories.manage',
            'gallery.manage',
            'faq.manage',
            'leadership.manage',
            'users.manage',
            'roles.manage',
            'activity.view',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $roles = [
            'Super Admin' => $permissions,
            'Content Manager' => [
                'dashboard.view',
                'cms.manage',
                'navigation.manage',
                'loans.view',
                'stories.manage',
                'gallery.manage',
                'faq.manage',
                'leadership.manage',
            ],
            'Loan Manager' => [
                'dashboard.view',
                'loans.view',
                'loans.create',
                'loans.edit',
                'loans.delete',
                'applications.view',
                'applications.update',
                'applications.export',
                'stories.manage',
            ],
            'Customer Support' => [
                'dashboard.view',
                'applications.view',
                'applications.update',
                'inquiries.view',
                'inquiries.update',
                'inquiries.export',
                'faq.manage',
            ],
            'Viewer' => [
                'dashboard.view',
                'loans.view',
                'applications.view',
                'inquiries.view',
                'activity.view',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::findOrCreate($roleName, 'web');
            $role->syncPermissions($rolePermissions);
        }
    }
}
