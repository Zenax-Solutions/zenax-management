<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customer can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the customer can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Customer  $model
     * @return mixed
     */
    public function view(User $user, Customer $model)
    {
        return true;
    }

    /**
     * Determine whether the customer can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the customer can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Customer  $model
     * @return mixed
     */
    public function update(User $user, Customer $model)
    {
        return true;
    }

    /**
     * Determine whether the customer can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Customer  $model
     * @return mixed
     */
    public function delete(User $user, Customer $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Customer  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the customer can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Customer  $model
     * @return mixed
     */
    public function restore(User $user, Customer $model)
    {
        return false;
    }

    /**
     * Determine whether the customer can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Customer  $model
     * @return mixed
     */
    public function forceDelete(User $user, Customer $model)
    {
        return false;
    }
}
