<?php

namespace App\Policies;

use App\Models\TableType;
use App\Models\User;

class TableTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_tables');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TableType $tableType): bool {}

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_tables');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TableType $tableType): bool
    {
        return $user->hasPermissionTo('edit_tables');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TableType $tableType): bool
    {
        return $user->hasPermissionTo('delete_tables');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TableType $tableType): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TableType $tableType): bool
    {
        return false;
    }
}
