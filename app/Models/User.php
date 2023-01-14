<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_role',
        'location'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'id_role');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'id_user', 'id');
    }

    public function commentAnnouncements()
    {
        return $this->hasMany(CommentAnnouncement::class, 'id_user', 'id');
    }

    public function commentPosts()
    {
        return $this->hasMany(CommentPost::class, 'id_user', 'id');
    }

    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class, 'id_user', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'id_user', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_user', 'id');
    }

    public function userChats()
    {
        return $this->hasMany(UserChat::class, 'id_user', 'id');
    }
}
