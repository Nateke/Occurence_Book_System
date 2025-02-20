<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the booking can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bookings');
    }

    /**
     * Determine whether the booking can view the model.
     */
    public function view(User $user, Booking $model): bool
    {
        return $user->hasPermissionTo('view bookings');
    }

    /**
     * Determine whether the booking can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bookings');
    }

    /**
     * Determine whether the booking can update the model.
     */
    public function update(User $user, Booking $model): bool
    {
        return $user->hasPermissionTo('update bookings');
    }

    /**
     * Determine whether the booking can delete the model.
     */
    public function delete(User $user, Booking $model): bool
    {
        return $user->hasPermissionTo('delete bookings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bookings');
    }

    /**
     * Determine whether the booking can restore the model.
     */
    public function restore(User $user, Booking $model): bool
    {
        return false;
    }

    /**
     * Determine whether the booking can permanently delete the model.
     */
    public function forceDelete(User $user, Booking $model): bool
    {
        return false;
    }
}
