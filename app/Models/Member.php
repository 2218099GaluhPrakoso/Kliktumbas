<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'phone', 'gender', 'birth_date', 'email', 'password', 'profile_image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

