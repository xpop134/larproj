<?php

// In app/Models/Role.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Add the $fillable property to allow mass assignment for slug and name
    protected $fillable = ['slug', 'name'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_users', 'role_id', 'user_id');
    }
}

