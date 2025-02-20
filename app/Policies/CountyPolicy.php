<?php

namespace App\Policies;

use App\Models\User;
use App\Models\County;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the county can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list counties');
    }

    /**
     * Determine whether the county can view the model.
     */
    public function view(User $user, County $model): bool
    {
        return $user->hasPermissionTo('view counties');
    }

    /**
     * Determine whether the county can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create counties');
    }

    /**
     * Determine whether the county can update the model.
     */
    public function update(User $user, County $model): bool
    {
        return $user->hasPermissionTo('update counties');
    }

    /**
     * Determine whether the county can delete the model.
     */
    public function delete(User $user, County $model): bool
    {
        return $user->hasPermissionTo('delete counties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete counties');
    }

    /**
     * Determine whether the county can restore the model.
     */
    public function restore(User $user, County $model): bool
    {
        return false;
    }

    /**
     * Determine whether the county can permanently delete the model.
     */
    public function forceDelete(User $user, County $model): bool
    {
        return false;
    }
}
