<?php

namespace App\Policies;

use App\Models\LeadershipMember;
use App\Models\User;

class LeadershipMemberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('leadership.manage');
    }

    public function view(User $user, LeadershipMember $leadershipMember): bool
    {
        return $user->can('leadership.manage');
    }

    public function create(User $user): bool
    {
        return $user->can('leadership.manage');
    }

    public function update(User $user, LeadershipMember $leadershipMember): bool
    {
        return $user->can('leadership.manage');
    }

    public function delete(User $user, LeadershipMember $leadershipMember): bool
    {
        return $user->can('leadership.manage');
    }
}
