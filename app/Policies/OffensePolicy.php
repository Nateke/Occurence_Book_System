<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Offense;
use Illuminate\Auth\Access\HandlesAuthorization;

class OffensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the offense can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list offenses');
    }

    /**
     * Determine whether the offense can view the model.
     */
    public function view(User $user, Offense $model): bool
    {
        return $user->hasPermissionTo('view offenses');
    }

    /**
     * Determine whether the offense can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create offenses');
    }

    /**
     * Determine whether the offense can update the model.
     */
    public function update(User $user, Offense $model): bool
    {
        return $user->hasPermissionTo('update offenses');
    }

    /**
     * Determine whether the offense can delete the model.
     */
    public function delete(User $user, Offense $model): bool
    {
        return $user->hasPermissionTo('delete offenses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete offenses');
    }

    /**
     * Determine whether the offense can restore the model.
     */
    public function restore(User $user, Offense $model): bool
    {
        return false;
    }

    /**
     * Determine whether the offense can permanently delete the model.
     */
    public function forceDelete(User $user, Offense $model): bool
    {
        return false;
    }
}
