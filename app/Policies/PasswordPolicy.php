<?php

namespace App\Policies;

use App\Models\Password;
use App\Models\User;

class PasswordPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Password $password): bool
    {
        return $password->team_id === $user->current_team_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Password $password): bool
    {
        return $password->team_id === $user->current_team_id;
    }

    public function delete(User $user, Password $password): bool
    {
        return $password->team_id === $user->current_team_id;
    }

    public function restore(User $user, Password $password): bool
    {
        return $password->team_id === $user->current_team_id;
    }

    public function forceDelete(User $user, Password $password): bool
    {
        return $password->team_id === $user->current_team_id;
    }
}
