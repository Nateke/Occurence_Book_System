<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FlatsBail;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlatsBailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the flatsBail can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list flatsbails');
    }

    /**
     * Determine whether the flatsBail can view the model.
     */
    public function view(User $user, FlatsBail $model): bool
    {
        return $user->hasPermissionTo('view flatsbails');
    }

    /**
     * Determine whether the flatsBail can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create flatsbails');
    }

    /**
     * Determine whether the flatsBail can update the model.
     */
    public function update(User $user, FlatsBail $model): bool
    {
        return $user->hasPermissionTo('update flatsbails');
    }

    /**
     * Determine whether the flatsBail can delete the model.
     */
    public function delete(User $user, FlatsBail $model): bool
    {
        return $user->hasPermissionTo('delete flatsbails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete flatsbails');
    }

    /**
     * Determine whether the flatsBail can restore the model.
     */
    public function restore(User $user, FlatsBail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the flatsBail can permanently delete the model.
     */
    public function forceDelete(User $user, FlatsBail $model): bool
    {
        return false;
    }
}
