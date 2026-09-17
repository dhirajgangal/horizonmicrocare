<?php

namespace App\Policies;

use App\Models\LoanApplicationDocument;
use App\Models\User;

class LoanApplicationDocumentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('applications.view');
    }

    public function view(User $user, LoanApplicationDocument $loanApplicationDocument): bool
    {
        return $user->can('applications.view');
    }

    public function create(User $user): bool
    {
        return $user->can('applications.update');
    }

    public function update(User $user, LoanApplicationDocument $loanApplicationDocument): bool
    {
        return $user->can('applications.update');
    }

    public function delete(User $user, LoanApplicationDocument $loanApplicationDocument): bool
    {
        return $user->can('applications.update');
    }
}
