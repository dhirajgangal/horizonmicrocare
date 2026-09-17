<?php

namespace App\Policies;

use App\Models\LoanProduct;
use App\Models\User;

class LoanProductPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('loans.view');
    }

    public function view(User $user, LoanProduct $loanProduct): bool
    {
        return $user->can('loans.view');
    }

    public function create(User $user): bool
    {
        return $user->can('loans.create');
    }

    public function update(User $user, LoanProduct $loanProduct): bool
    {
        return $user->can('loans.edit');
    }

    public function delete(User $user, LoanProduct $loanProduct): bool
    {
        return $user->can('loans.delete');
    }
}
