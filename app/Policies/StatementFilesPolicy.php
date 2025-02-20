<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StatementFiles;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatementFilesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the statementFiles can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allstatementfiles');
    }

    /**
     * Determine whether the statementFiles can view the model.
     */
    public function view(User $user, StatementFiles $model): bool
    {
        return $user->hasPermissionTo('view allstatementfiles');
    }

    /**
     * Determine whether the statementFiles can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allstatementfiles');
    }

    /**
     * Determine whether the statementFiles can update the model.
     */
    public function update(User $user, StatementFiles $model): bool
    {
        return $user->hasPermissionTo('update allstatementfiles');
    }

    /**
     * Determine whether the statementFiles can delete the model.
     */
    public function delete(User $user, StatementFiles $model): bool
    {
        return $user->hasPermissionTo('delete allstatementfiles');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allstatementfiles');
    }

    /**
     * Determine whether the statementFiles can restore the model.
     */
    public function restore(User $user, StatementFiles $model): bool
    {
        return false;
    }

    /**
     * Determine whether the statementFiles can permanently delete the model.
     */
    public function forceDelete(User $user, StatementFiles $model): bool
    {
        return false;
    }
}
