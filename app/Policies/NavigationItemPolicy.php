<?php

namespace App\Policies;

use App\Models\NavigationItem;
use App\Models\User;

class NavigationItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('navigation.manage');
    }

    public function view(User $user, NavigationItem $navigationItem): bool
    {
        return $user->can('navigation.manage');
    }

    public function create(User $user): bool
    {
        return $user->can('navigation.manage');
    }

    public function update(User $user, NavigationItem $navigationItem): bool
    {
        return $user->can('navigation.manage');
    }

    public function delete(User $user, NavigationItem $navigationItem): bool
    {
        return $user->can('navigation.manage');
    }
}
