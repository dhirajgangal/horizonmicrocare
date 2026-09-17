<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LoanRelatedPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('loans.view');
    }

    public function view(User $user, Model $model): bool
    {
        return $user->can('loans.view');
    }

    public function create(User $user): bool
    {
        return $user->can('loans.edit');
    }

    public function update(User $user, Model $model): bool
    {
        return $user->can('loans.edit');
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->can('loans.delete');
    }
}
