<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\SendNotifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SendNotificationPolices
{
    public function before()
    {
        return Auth::user()->role === UserRole::Admin;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SendNotifications $sendNotifications): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SendNotifications $sendNotifications): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SendNotifications $sendNotifications): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SendNotifications $sendNotifications): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SendNotifications $sendNotifications): bool
    {
        return false;
    }
}
