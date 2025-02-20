<?php

namespace App\Policies;

use App\Models\Ward;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ward can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wards');
    }

    /**
     * Determine whether the ward can view the model.
     */
    public function view(User $user, Ward $model): bool
    {
        return $user->hasPermissionTo('view wards');
    }

    /**
     * Determine whether the ward can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wards');
    }

    /**
     * Determine whether the ward can update the model.
     */
    public function update(User $user, Ward $model): bool
    {
        return $user->hasPermissionTo('update wards');
    }

    /**
     * Determine whether the ward can delete the model.
     */
    public function delete(User $user, Ward $model): bool
    {
        return $user->hasPermissionTo('delete wards');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wards');
    }

    /**
     * Determine whether the ward can restore the model.
     */
    public function restore(User $user, Ward $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ward can permanently delete the model.
     */
    public function forceDelete(User $user, Ward $model): bool
    {
        return false;
    }
}
