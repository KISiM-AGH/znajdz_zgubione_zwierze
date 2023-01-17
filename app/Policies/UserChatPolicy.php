<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserChat;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserChatPolicy
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
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, UserChat $userChat)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('userchat:show') && $authUser->tokenCan('userchat:show-own') )
        {
            return $authUser->id == $userChat->id_user;
        }
        else if(!$authUser->tokenCan('userchat:show-own'))
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
        if($authUser->tokenCan('userchat:store'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, UserChat $userChat)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('userchat:update') && $authUser->tokenCan('userchat:update-own') )
        {
            return $user->id == $userChat->id_user;
        }
        else if(!$authUser->tokenCan('userchat:update-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, UserChat $userChat)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('userchat:destroy') && $authUser->tokenCan('userchat:destroy-own') )
        {
            return $user->id == $userChat->id_user;
        }
        else if(!$authUser->tokenCan('userchat:destroy-own'))
        {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, UserChat $userChat)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, UserChat $userChat)
    {
        //
    }
}
