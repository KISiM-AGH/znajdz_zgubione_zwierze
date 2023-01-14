<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAnnouncement extends Model
{
    use HasFactory;

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'id_type_announcement', 'id');
    }
}
