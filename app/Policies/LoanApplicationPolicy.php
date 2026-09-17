<?php

namespace App\Policies;

use App\Models\LoanApplication;
use App\Models\User;

class LoanApplicationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('applications.view');
    }

    public function view(User $user, LoanApplication $loanApplication): bool
    {
        return $user->can('applications.view');
    }

    public function create(User $user): bool
    {
        return $user->can('applications.update');
    }

    public function update(User $user, LoanApplication $loanApplication): bool
    {
        return $user->can('applications.update');
    }

    public function delete(User $user, LoanApplication $loanApplication): bool
    {
        return $user->can('applications.update');
    }

    public function restore(User $user, LoanApplication $loanApplication): bool
    {
        return $user->can('applications.update');
    }

    public function forceDelete(User $user, LoanApplication $loanApplication): bool
    {
        return false;
    }

    public function export(User $user): bool
    {
        return $user->can('applications.export');
    }
}
