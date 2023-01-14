<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public function coordinate()
    {
        return $this->hasOne(Coordinate::class, 'id', 'id_coordinate');
    }

    public function mediaFile()
    {
        return $this->hasOne(MediaFile::class, 'id', 'id_media_file');
    }

    public function commentAnnounecements()
    {
        return $this->hasMany(CommentAnnouncement::class, 'id_announcement', 'id');
    }

    public function typeAnnouncement()
    {
        return $this->belongsTo(TypeAnnouncement::class, 'id', 'id_type_announcement');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }

}
