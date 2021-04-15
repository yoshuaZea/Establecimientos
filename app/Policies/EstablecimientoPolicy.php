<?php

namespace App\Policies;

use App\User;
use App\Models\Establecimiento;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstablecimientoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return mixed
     */
    public function view(User $user, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return mixed
     */
    public function update(User $user, Establecimiento $establecimiento)
    {
        return $user->id === $establecimiento->user_id ? Response::allow() : Response::deny('No tienes permiso para actualizar este registro');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return mixed
     */
    public function delete(User $user, Establecimiento $establecimiento)
    {
        return $user->id === $establecimiento->user_id ? Response::allow() : Response::deny('No tienes permiso para actualizar este registro');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return mixed
     */
    public function restore(User $user, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return mixed
     */
    public function forceDelete(User $user, Establecimiento $establecimiento)
    {
        //
    }
}
