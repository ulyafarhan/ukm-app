<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registration;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_registration');
    }

    public function view(User $user, Registration $registration): bool
    {
        return $user->can('view_registration');
    }

    public function create(User $user): bool
    {
        return $user->can('create_registration');
    }

    public function update(User $user, Registration $registration): bool
    {
        return $user->can('update_registration');
    }

    public function delete(User $user, Registration $registration): bool
    {
        return $user->can('delete_registration');
    }
}