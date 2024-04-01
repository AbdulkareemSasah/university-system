<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SubjectLevelDoctor;
use App\Models\User;

class SubjectLevelDoctorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SubjectLevelDoctor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubjectLevelDoctor $subjectleveldoctor): bool
    {
        return $user->checkPermissionTo('view SubjectLevelDoctor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SubjectLevelDoctor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubjectLevelDoctor $subjectleveldoctor): bool
    {
        return $user->checkPermissionTo('update SubjectLevelDoctor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubjectLevelDoctor $subjectleveldoctor): bool
    {
        return $user->checkPermissionTo('delete SubjectLevelDoctor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubjectLevelDoctor $subjectleveldoctor): bool
    {
        return $user->checkPermissionTo('restore SubjectLevelDoctor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubjectLevelDoctor $subjectleveldoctor): bool
    {
        return $user->checkPermissionTo('force-delete SubjectLevelDoctor');
    }
}
