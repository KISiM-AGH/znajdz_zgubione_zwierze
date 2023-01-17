<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Policies\AnnouncementPolicy;
use App\Models\Chat;
use App\Policies\ChatPolicy;
use App\Models\CommentAnnouncement;
use App\Policies\CommentAnnouncementPolicy;
use App\Models\CommentPost;
use App\Policies\CommentPostPolicy;
use App\Models\Coordinate;
use App\Policies\CoordinatePolicy;
use App\Models\MediaFile;
use App\Policies\MediaFilePolicy;
use App\Models\Message;
use App\Policies\MessagePolicy;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Models\TypeAnnouncement;
use App\Policies\TypeAnnouncementPolicy;
use App\Models\UserChat;
use App\Policies\UserChatPolicy;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Announcement::class => AnnouncementPolicy::class,
        Chat::class => ChatPolicy::class,
        CommentAnnouncement::class => CommentAnnouncementPolicy::class,
        CommentPostPolicy::class => CommentPostPolicy::class,
        Coordinate::class => CoordinatePolicy::class,
        MediaFile::class => MediaFilePolicy::class,
        Message::class => MessagePolicy::class,
        Post::class => PostPolicy::class,
        TypeAnnouncement::class => TypeAnnouncementPolicy::class,
        UserChat::class => UserChatPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
