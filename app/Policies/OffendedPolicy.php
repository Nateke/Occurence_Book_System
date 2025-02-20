<?php

namespace App\Policies;

use App\Models\Offended;
use App\Models\User;
use App\Models\Offender;
use Illuminate\Auth\Access\HandlesAuthorization;

class OffendedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the offender can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list offenders');
    }

    /**
     * Determine whether the offender can view the model.
     */
    public function view(User $user, Offended $model): bool
    {
        return $user->hasPermissionTo('view offenders');
    }

    /**
     * Determine whether the offender can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create offenders');
    }

    /**
     * Determine whether the offender can update the model.
     */
    public function update(User $user, Offended $model): bool
    {
        return $user->hasPermissionTo('update offenders');
    }

    /**
     * Determine whether the offender can delete the model.
     */
    public function delete(User $user, Offended $model): bool
    {
        return $user->hasPermissionTo('delete offenders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete offenders');
    }

    /**
     * Determine whether the offender can restore the model.
     */
    public function restore(User $user, Offended $model): bool
    {
        return false;
    }

    /**
     * Determine whether the offender can permanently delete the model.
     */
    public function forceDelete(User $user, Offender $model): bool
    {
        return false;
    }
}
