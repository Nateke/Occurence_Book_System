<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OffenseCase;
use Illuminate\Auth\Access\HandlesAuthorization;

class OffenseCasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the offenseCase can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list offensecases');
    }

    /**
     * Determine whether the offenseCase can view the model.
     */
    public function view(User $user, OffenseCase $model): bool
    {
        return $user->hasPermissionTo('view offensecases');
    }

    /**
     * Determine whether the offenseCase can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create offensecases');
    }

    /**
     * Determine whether the offenseCase can update the model.
     */
    public function update(User $user, OffenseCase $model): bool
    {
        return $user->hasPermissionTo('update offensecases');
    }

    /**
     * Determine whether the offenseCase can delete the model.
     */
    public function delete(User $user, OffenseCase $model): bool
    {
        return $user->hasPermissionTo('delete offensecases');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete offensecases');
    }

    /**
     * Determine whether the offenseCase can restore the model.
     */
    public function restore(User $user, OffenseCase $model): bool
    {
        return false;
    }

    /**
     * Determine whether the offenseCase can permanently delete the model.
     */
    public function forceDelete(User $user, OffenseCase $model): bool
    {
        return false;
    }
}
