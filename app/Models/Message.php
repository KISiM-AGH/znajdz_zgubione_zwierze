<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'id_chat',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id', 'id_chat');
    }
}
