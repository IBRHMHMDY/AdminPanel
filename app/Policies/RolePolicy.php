<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Super Admin'); // حصرياً للسوبر أدمن
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function update(User $user, $role): bool
    {
        return $user->hasRole('Super Admin');
    }
}
