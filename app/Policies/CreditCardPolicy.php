<?php

namespace App\Policies;

use App\Models\CreditCard;
use App\Models\User;

class CreditCardPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->team_id === $user->current_team_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->team_id === $user->current_team_id;
    }

    public function delete(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->team_id === $user->current_team_id;
    }

    public function restore(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->team_id === $user->current_team_id;
    }

    public function forceDelete(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->team_id === $user->current_team_id;
    }
}
