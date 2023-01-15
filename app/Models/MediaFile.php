<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'url',
        'id_user'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id', 'id_post');
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'id_media_file', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }
}
