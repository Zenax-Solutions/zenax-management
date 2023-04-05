<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankAccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bankAccount can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the bankAccount can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankAccount  $model
     * @return mixed
     */
    public function view(User $user, BankAccount $model)
    {
        return true;
    }

    /**
     * Determine whether the bankAccount can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the bankAccount can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankAccount  $model
     * @return mixed
     */
    public function update(User $user, BankAccount $model)
    {
        return true;
    }

    /**
     * Determine whether the bankAccount can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankAccount  $model
     * @return mixed
     */
    public function delete(User $user, BankAccount $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankAccount  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the bankAccount can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankAccount  $model
     * @return mixed
     */
    public function restore(User $user, BankAccount $model)
    {
        return false;
    }

    /**
     * Determine whether the bankAccount can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankAccount  $model
     * @return mixed
     */
    public function forceDelete(User $user, BankAccount $model)
    {
        return false;
    }
}
