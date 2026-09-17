<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\User;

class InquiryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('inquiries.view');
    }

    public function view(User $user, Inquiry $inquiry): bool
    {
        return $user->can('inquiries.view');
    }

    public function create(User $user): bool
    {
        return $user->can('inquiries.update');
    }

    public function update(User $user, Inquiry $inquiry): bool
    {
        return $user->can('inquiries.update');
    }

    public function delete(User $user, Inquiry $inquiry): bool
    {
        return $user->can('inquiries.update');
    }

    public function restore(User $user, Inquiry $inquiry): bool
    {
        return $user->can('inquiries.update');
    }

    public function forceDelete(User $user, Inquiry $inquiry): bool
    {
        return false;
    }

    public function export(User $user): bool
    {
        return $user->can('inquiries.export');
    }
}
