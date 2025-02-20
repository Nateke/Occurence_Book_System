<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Region;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the region can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list regions');
    }

    /**
     * Determine whether the region can view the model.
     */
    public function view(User $user, Region $model): bool
    {
        return $user->hasPermissionTo('view regions');
    }

    /**
     * Determine whether the region can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create regions');
    }

    /**
     * Determine whether the region can update the model.
     */
    public function update(User $user, Region $model): bool
    {
        return $user->hasPermissionTo('update regions');
    }

    /**
     * Determine whether the region can delete the model.
     */
    public function delete(User $user, Region $model): bool
    {
        return $user->hasPermissionTo('delete regions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete regions');
    }

    /**
     * Determine whether the region can restore the model.
     */
    public function restore(User $user, Region $model): bool
    {
        return false;
    }

    /**
     * Determine whether the region can permanently delete the model.
     */
    public function forceDelete(User $user, Region $model): bool
    {
        return false;
    }
}
