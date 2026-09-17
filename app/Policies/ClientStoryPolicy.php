<?php

namespace App\Policies;

use App\Models\ClientStory;
use App\Models\User;

class ClientStoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('stories.manage');
    }

    public function view(User $user, ClientStory $clientStory): bool
    {
        return $user->can('stories.manage');
    }

    public function create(User $user): bool
    {
        return $user->can('stories.manage');
    }

    public function update(User $user, ClientStory $clientStory): bool
    {
        return $user->can('stories.manage');
    }

    public function delete(User $user, ClientStory $clientStory): bool
    {
        return $user->can('stories.manage');
    }
}
