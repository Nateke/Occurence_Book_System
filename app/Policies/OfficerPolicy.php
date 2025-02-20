<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Officer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the officer can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list officers');
    }

    /**
     * Determine whether the officer can view the model.
     */
    public function view(User $user, Officer $model): bool
    {
        return $user->hasPermissionTo('view officers');
    }

    /**
     * Determine whether the officer can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create officers');
    }

    /**
     * Determine whether the officer can update the model.
     */
    public function update(User $user, Officer $model): bool
    {
        return $user->hasPermissionTo('update officers');
    }

    /**
     * Determine whether the officer can delete the model.
     */
    public function delete(User $user, Officer $model): bool
    {
        return $user->hasPermissionTo('delete officers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete officers');
    }

    /**
     * Determine whether the officer can restore the model.
     */
    public function restore(User $user, Officer $model): bool
    {
        return false;
    }

    /**
     * Determine whether the officer can permanently delete the model.
     */
    public function forceDelete(User $user, Officer $model): bool
    {
        return false;
    }
}
