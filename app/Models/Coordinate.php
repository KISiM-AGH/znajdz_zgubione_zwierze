<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    use HasFactory;

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'id_coordinate', 'id');
    }
}
