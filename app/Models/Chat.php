<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function userChats()
    {
        return $this->hasMany(UserChat::class, 'id_chat', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'id_chat', 'id');
    }
}
