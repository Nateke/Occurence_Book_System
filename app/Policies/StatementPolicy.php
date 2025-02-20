<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Statement;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the statement can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list statements');
    }

    /**
     * Determine whether the statement can view the model.
     */
    public function view(User $user, Statement $model): bool
    {
        return $user->hasPermissionTo('view statements');
    }

    /**
     * Determine whether the statement can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create statements');
    }

    /**
     * Determine whether the statement can update the model.
     */
    public function update(User $user, Statement $model): bool
    {
        return $user->hasPermissionTo('update statements');
    }

    /**
     * Determine whether the statement can delete the model.
     */
    public function delete(User $user, Statement $model): bool
    {
        return $user->hasPermissionTo('delete statements');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete statements');
    }

    /**
     * Determine whether the statement can restore the model.
     */
    public function restore(User $user, Statement $model): bool
    {
        return false;
    }

    /**
     * Determine whether the statement can permanently delete the model.
     */
    public function forceDelete(User $user, Statement $model): bool
    {
        return false;
    }
}
