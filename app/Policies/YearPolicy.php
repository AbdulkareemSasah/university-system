<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Year;
use App\Models\User;

class YearPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Year');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Year $year): bool
    {
        return $user->checkPermissionTo('view Year');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Year');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Year $year): bool
    {
        return $user->checkPermissionTo('update Year');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Year $year): bool
    {
        return $user->checkPermissionTo('delete Year');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Year $year): bool
    {
        return $user->checkPermissionTo('restore Year');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Year $year): bool
    {
        return $user->checkPermissionTo('force-delete Year');
    }
}
