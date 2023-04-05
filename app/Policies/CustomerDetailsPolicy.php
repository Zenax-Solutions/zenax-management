<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CustomerDetails;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerDetailsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customerDetails can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the customerDetails can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerDetails  $model
     * @return mixed
     */
    public function view(User $user, CustomerDetails $model)
    {
        return true;
    }

    /**
     * Determine whether the customerDetails can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the customerDetails can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerDetails  $model
     * @return mixed
     */
    public function update(User $user, CustomerDetails $model)
    {
        return true;
    }

    /**
     * Determine whether the customerDetails can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerDetails  $model
     * @return mixed
     */
    public function delete(User $user, CustomerDetails $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerDetails  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the customerDetails can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerDetails  $model
     * @return mixed
     */
    public function restore(User $user, CustomerDetails $model)
    {
        return false;
    }

    /**
     * Determine whether the customerDetails can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerDetails  $model
     * @return mixed
     */
    public function forceDelete(User $user, CustomerDetails $model)
    {
        return false;
    }
}
