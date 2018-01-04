<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
	}

    public function authorizeRoles($roles)
    {
		if (is_array($roles)) {
			return $this->hasAnyRoles($roles) || abort(401, 'This action is unauthorized.');
		}

		return $this->hasRole($roles) || abort(401, 'This action is unathorized.');
	}

    public function hasAnyRoles($roles)
    {
		return null !== $this->roles()->whereIn('name', $roles)->first();
	}

    public function hasRole($role)
    {
		return null !== $this->roles()->where('name', $role)->first();
	}
}
