<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
