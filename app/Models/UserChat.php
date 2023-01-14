<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }
    
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id', 'id_chat');
    }
}
