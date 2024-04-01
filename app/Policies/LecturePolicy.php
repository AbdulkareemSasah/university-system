<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Lecture;
use App\Models\User;

class LecturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Lecture');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lecture $lecture): bool
    {
        return $user->checkPermissionTo('view Lecture');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Lecture');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lecture $lecture): bool
    {
        return $user->checkPermissionTo('update Lecture');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lecture $lecture): bool
    {
        return $user->checkPermissionTo('delete Lecture');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lecture $lecture): bool
    {
        return $user->checkPermissionTo('restore Lecture');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lecture $lecture): bool
    {
        return $user->checkPermissionTo('force-delete Lecture');
    }
}
