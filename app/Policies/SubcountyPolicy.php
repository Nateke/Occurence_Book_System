<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subcounty;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubcountyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subcounty can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subcounties');
    }

    /**
     * Determine whether the subcounty can view the model.
     */
    public function view(User $user, Subcounty $model): bool
    {
        return $user->hasPermissionTo('view subcounties');
    }

    /**
     * Determine whether the subcounty can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subcounties');
    }

    /**
     * Determine whether the subcounty can update the model.
     */
    public function update(User $user, Subcounty $model): bool
    {
        return $user->hasPermissionTo('update subcounties');
    }

    /**
     * Determine whether the subcounty can delete the model.
     */
    public function delete(User $user, Subcounty $model): bool
    {
        return $user->hasPermissionTo('delete subcounties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subcounties');
    }

    /**
     * Determine whether the subcounty can restore the model.
     */
    public function restore(User $user, Subcounty $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subcounty can permanently delete the model.
     */
    public function forceDelete(User $user, Subcounty $model): bool
    {
        return false;
    }
}
