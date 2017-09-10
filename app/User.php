<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = array(
        'name',
        'email',
        'password',
        'status',
        'role_id',
    );

    protected $hidden = array(
        'password',
        'remember_token',
        'status',
        'role_id',
    );
}
