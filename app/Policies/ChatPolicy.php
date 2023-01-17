<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ChatPolicy
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
        $authUser = Auth::user();
        if(!$authUser->tokenCan('chat:show-all') && $authUser->tokenCan('chat:show-own') )
        {
            return $user->id == $announcement->id_user;
        }
        else if(!$authUser->tokenCan('chat:show-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Chat $chat)
    {
        //
        $authUser = Auth::user();
        $userChat = UserChat::where('id_user', 'LIKE', $authUser->id)->where('id_chat', 'LIKE', $chat->id)->get();
        if(!$authUser->tokenCan('chat:show') && $authUser->tokenCan('chat:show-own') )
        {
            if($userChat->first())
                return $chat->id == $userChat[0]->id_chat;
            else
            {
                return false;
            }
        }
        else if(!$authUser->tokenCan('chat:show-own'))
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
        if($authUser->tokenCan('chat:store'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Chat $chat)
    {
        //
        $authUser = Auth::user();
        $userChat = UserChat::where('id_user', 'LIKE', $authUser->id)->where('id_chat', 'LIKE', $chat->id)->get();
        if(!$authUser->tokenCan('chat:update') && $authUser->tokenCan('chat:update-own') )
        {
            if($userChat->first())
                return $userChat[0]->id_chat == $chat->id;
            else 
            return false;
        }
        else if(!$authUser->tokenCan('chat:update-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Chat $chat)
    {
        //
        $authUser = Auth::user();
        $userChat = UserChat::where('id_user', 'LIKE', $authUser->id)->where('id_chat', 'LIKE', $chat->id)->get();
        if(!$authUser->tokenCan('chat:destroy') && $authUser->tokenCan('chat:destroy-own') )
        {
            if($userChat->first())
                return $userChat[0]->id_chat == $chat->id;
            else
            {
                return false;
            }
        }
        else if(!$authUser->tokenCan('chat:destroy-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Chat $chat)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Chat $chat)
    {
        //
    }
}
