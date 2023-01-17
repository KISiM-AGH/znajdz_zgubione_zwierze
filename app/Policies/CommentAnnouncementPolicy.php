<?php

namespace App\Policies;

use App\Models\CommentAnnouncement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentAnnouncementPolicy
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
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CommentAnnouncement $commentAnnouncement)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('comment-announcement:show') && $authUser->tokenCan('comment-announcement:show-own') )
        {
            return $user->id == $commentAnnouncement->id_user;
        }
        else if(!$authUser->tokenCan('comment-announcement:show-own'))
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
        if($authUser->tokenCan('comment-announcement:store'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CommentAnnouncement $commentAnnouncement)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('comment-announcement:update') && $authUser->tokenCan('comment-announcement:update-own') )
        {
            return $user->id == $commentAnnouncement->id_user;
        }
        else if(!$authUser->tokenCan('comment-announcement:update-own'))
        {
            return false;
        }
        
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CommentAnnouncement $commentAnnouncement)
    {
        //
        $authUser = Auth::user();
        if(!$authUser->tokenCan('comment-announcement:destroy') && $authUser->tokenCan('comment-announcement:destroy-own') )
        {
            return $user->id == $commentAnnouncement->id_user;
        }
        else if(!$authUser->tokenCan('comment-announcement:destroy-own'))
        {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CommentAnnouncement $commentAnnouncement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CommentAnnouncement $commentAnnouncement)
    {
        //
    }
}
