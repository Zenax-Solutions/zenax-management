<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FacebookAd;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacebookAdPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the facebookAd can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the facebookAd can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FacebookAd  $model
     * @return mixed
     */
    public function view(User $user, FacebookAd $model)
    {
        return true;
    }

    /**
     * Determine whether the facebookAd can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the facebookAd can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FacebookAd  $model
     * @return mixed
     */
    public function update(User $user, FacebookAd $model)
    {
        return true;
    }

    /**
     * Determine whether the facebookAd can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FacebookAd  $model
     * @return mixed
     */
    public function delete(User $user, FacebookAd $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FacebookAd  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the facebookAd can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FacebookAd  $model
     * @return mixed
     */
    public function restore(User $user, FacebookAd $model)
    {
        return false;
    }

    /**
     * Determine whether the facebookAd can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FacebookAd  $model
     * @return mixed
     */
    public function forceDelete(User $user, FacebookAd $model)
    {
        return false;
    }
}
