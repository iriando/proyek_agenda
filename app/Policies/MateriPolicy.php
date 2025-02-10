<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Materi;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class MateriPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view materi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Materi $materi): bool
    {
        return $user->hasPermissionTo('view materi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create materi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Materi $materi): bool
    {
        return $user->hasPermissionTo('edit materi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Materi $materi): bool
    {
        return $user->hasPermissionTo('delete materi');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Materi $materi): bool
    {
        return $user->hasPermissionTo('restore materi');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Materi $materi): bool
    {
        return $user->hasPermissionTo('force delete materi');
    }
}
