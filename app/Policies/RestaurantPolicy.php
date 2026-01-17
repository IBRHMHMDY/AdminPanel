<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;

class RestaurantPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_restaurants');
    }

    public function view(User $user, Restaurant $restaurant): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_restaurants');
    }

    public function update(User $user, Restaurant $restaurant): bool
    {
        return $user->hasPermissionTo('update_restaurants');
    }

    public function delete(User $user, Restaurant $restaurant): bool
    {
        return $user->hasPermissionTo('delete_restaurants');
    }
}
