<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolMember extends Model
{
    use HasFactory;
    public function school_classes() {
        return $this->belongsTo(SchoolClass::class);
    }
    public function users() {
        return $this->belongsTo(User::class);
    }
    public function chat_members() {
        return $this->hasMany(ChatMember::class);
    }
}
