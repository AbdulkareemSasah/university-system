<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ClassRoom;
use App\Models\User;

class ClassRoomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ClassRoom');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ClassRoom $classroom): bool
    {
        return $user->checkPermissionTo('view ClassRoom');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ClassRoom');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ClassRoom $classroom): bool
    {
        return $user->checkPermissionTo('update ClassRoom');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ClassRoom $classroom): bool
    {
        return $user->checkPermissionTo('delete ClassRoom');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClassRoom $classroom): bool
    {
        return $user->checkPermissionTo('restore ClassRoom');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClassRoom $classroom): bool
    {
        return $user->checkPermissionTo('force-delete ClassRoom');
    }
}
