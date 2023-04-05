<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the orders can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the orders can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orders  $model
     * @return mixed
     */
    public function view(User $user, Orders $model)
    {
        return true;
    }

    /**
     * Determine whether the orders can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the orders can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orders  $model
     * @return mixed
     */
    public function update(User $user, Orders $model)
    {
        return true;
    }

    /**
     * Determine whether the orders can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orders  $model
     * @return mixed
     */
    public function delete(User $user, Orders $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orders  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the orders can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orders  $model
     * @return mixed
     */
    public function restore(User $user, Orders $model)
    {
        return false;
    }

    /**
     * Determine whether the orders can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orders  $model
     * @return mixed
     */
    public function forceDelete(User $user, Orders $model)
    {
        return false;
    }
}
