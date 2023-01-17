<?php

namespace App\Policies;

use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MediaFilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaFile  $mediaFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MediaFile $mediaFile)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('media-file:show') && $authUser->tokenCan('media-file:show-own') )
        {
            return $user->id == $mediaFile->id_user;
        }
        else if(!$authUser->tokenCan('media-file:show-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        $authUser = Auth::user();
        if($authUser->tokenCan('media-file:store'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaFile  $mediaFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MediaFile $mediaFile)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('media-file:update') && $authUser->tokenCan('media-file:update-own') )
        {
            return $user->id == $mediaFile->id_user;
        }
        else if(!$authUser->tokenCan('media-file:update-own'))
        {
            return false;
        }
        
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaFile  $mediaFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MediaFile $mediaFile)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('media-file:destroy') && $authUser->tokenCan('media-file:destroy-own') )
        {
            return $user->id == $mediaFile->id_user;
        }
        else if(!$authUser->tokenCan('media-file:destroy-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaFile  $mediaFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaFile  $mediaFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MediaFile $mediaFile)
    {
        //
    }
}
