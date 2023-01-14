<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function mediaFile()
    {
        return $this->hasOne(MediaFile::class, 'id', 'id_media_file');
    }

    public function commentPosts()
    {
        return $this->hasMany(CommentPost::class, 'id_post', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }
}
