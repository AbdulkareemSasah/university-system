<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Level;
use App\Models\User;

class LevelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Level');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Level $level): bool
    {
        return $user->checkPermissionTo('view Level');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Level');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Level $level): bool
    {
        return $user->checkPermissionTo('update Level');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Level $level): bool
    {
        return $user->checkPermissionTo('delete Level');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Level $level): bool
    {
        return $user->checkPermissionTo('restore Level');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Level $level): bool
    {
        return $user->checkPermissionTo('force-delete Level');
    }
}
