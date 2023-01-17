<?php

namespace App\Policies;

use App\Models\Coordinate;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CoordinatePolicy
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
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Coordinate $coordinate)
    {
        //
        $authUser = Auth::user();
        $userAnnouncement = Announcement::where('id_user', 'LIKE', $authUser->id)->where('id_coordinate', 'LIKE', $coordinate->id)->get();
        if(!$authUser->tokenCan('coordinate:show') && $authUser->tokenCan('coordinate:show-own') )
        {
            if($userAnnouncement->first())
                return $coordinate->id == $userAnnouncement[0]->id;
            else
            {
                return false;
            }
        }
        else if(!$authUser->tokenCan('coordinate:show-own'))
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
        if($authUser->tokenCan('coordinate:store'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Coordinate $coordinate)
    {
        //
        $authUser = Auth::user();
        $userCoordinate = Announcement::where('id_user', 'LIKE', $authUser->id)->where('id_coordinate', 'LIKE', $coordinate->id)->get();
        if(!$authUser->tokenCan('coordinate:update') && $authUser->tokenCan('coordinate:update-own') )
        {
            if($userCoordinate->first())
                return $userCoordinate[0]->id_coordinate == $coordinate->id;
            else 
            return false;
        }
        else if(!$authUser->tokenCan('coordinate:update-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Coordinate $coordinate)
    {
        //
        $authUser = Auth::user();
        $userCoordinate = Announcement::where('id_user', 'LIKE', $authUser->id)->where('id_coordinate', 'LIKE', $coordinate->id)->get();
        if(!$authUser->tokenCan('coordinate:destroy') && $authUser->tokenCan('coordinate:destroy-own') )
        {
            if($userCoordinate->first())
                return $userCoordinate[0]->id_coordinate == $coordinate->id;
            else 
            return false;
        }
        else if(!$authUser->tokenCan('coordinate:destroy-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Coordinate $coordinate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Coordinate $coordinate)
    {
        //
    }
}
