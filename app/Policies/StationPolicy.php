<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Station;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the station can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list stations');
    }

    /**
     * Determine whether the station can view the model.
     */
    public function view(User $user, Station $model): bool
    {
        return $user->hasPermissionTo('view stations');
    }

    /**
     * Determine whether the station can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create stations');
    }

    /**
     * Determine whether the station can update the model.
     */
    public function update(User $user, Station $model): bool
    {
        return $user->hasPermissionTo('update stations');
    }

    /**
     * Determine whether the station can delete the model.
     */
    public function delete(User $user, Station $model): bool
    {
        return $user->hasPermissionTo('delete stations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete stations');
    }

    /**
     * Determine whether the station can restore the model.
     */
    public function restore(User $user, Station $model): bool
    {
        return false;
    }

    /**
     * Determine whether the station can permanently delete the model.
     */
    public function forceDelete(User $user, Station $model): bool
    {
        return false;
    }
}
