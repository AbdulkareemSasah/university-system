<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\General;
use App\Models\User;

class GeneralPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any General');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, General $general): bool
    {
        return $user->checkPermissionTo('view General');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create General');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, General $general): bool
    {
        return $user->checkPermissionTo('update General');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, General $general): bool
    {
        return $user->checkPermissionTo('delete General');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, General $general): bool
    {
        return $user->checkPermissionTo('restore General');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, General $general): bool
    {
        return $user->checkPermissionTo('force-delete General');
    }
}
