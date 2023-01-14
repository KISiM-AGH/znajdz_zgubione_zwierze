<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentAnnouncement extends Model
{
    use HasFactory;

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'id', 'id_announcement');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }

}
