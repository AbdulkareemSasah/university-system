<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Collage;
use App\Models\User;

class CollagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Collage');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Collage $collage): bool
    {
        return $user->checkPermissionTo('view Collage');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Collage');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Collage $collage): bool
    {
        return $user->checkPermissionTo('update Collage');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Collage $collage): bool
    {
        return $user->checkPermissionTo('delete Collage');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Collage $collage): bool
    {
        return $user->checkPermissionTo('restore Collage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Collage $collage): bool
    {
        return $user->checkPermissionTo('force-delete Collage');
    }
}
