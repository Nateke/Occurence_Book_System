<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Signature;
use Illuminate\Auth\Access\HandlesAuthorization;

class SignaturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the signature can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list signatures');
    }

    /**
     * Determine whether the signature can view the model.
     */
    public function view(User $user, Signature $model): bool
    {
        return $user->hasPermissionTo('view signatures');
    }

    /**
     * Determine whether the signature can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create signatures');
    }

    /**
     * Determine whether the signature can update the model.
     */
    public function update(User $user, Signature $model): bool
    {
        return $user->hasPermissionTo('update signatures');
    }

    /**
     * Determine whether the signature can delete the model.
     */
    public function delete(User $user, Signature $model): bool
    {
        return $user->hasPermissionTo('delete signatures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete signatures');
    }

    /**
     * Determine whether the signature can restore the model.
     */
    public function restore(User $user, Signature $model): bool
    {
        return false;
    }

    /**
     * Determine whether the signature can permanently delete the model.
     */
    public function forceDelete(User $user, Signature $model): bool
    {
        return false;
    }
}
