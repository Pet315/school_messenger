<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMember extends Model
{
    use HasFactory;
    public function chats() {
        return $this->belongsTo(Chat::class);
    }
    public function users() {
        return $this->belongsTo(User::class);
    }
}
