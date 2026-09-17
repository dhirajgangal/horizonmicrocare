<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GalleryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('gallery.manage');
    }

    public function view(User $user, Model $model): bool
    {
        return $user->can('gallery.manage');
    }

    public function create(User $user): bool
    {
        return $user->can('gallery.manage');
    }

    public function update(User $user, Model $model): bool
    {
        return $user->can('gallery.manage');
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->can('gallery.manage');
    }
}
