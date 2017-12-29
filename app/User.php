<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    /**
     * Does the user have a particular role?
     *
     * @param $name
     * @return bool
     */
    public function hasRole($name)
    {
        if (is_array($name)) {
            foreach ($this->roles as $role) {
                if (in_array($role->name, $name)) {
                    return true;
                }
            }
        } elseif (is_string($name)) {
            foreach ($this->roles as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        } else {
            return false;
        }

        return false;
    }

    /**
     * Add role to current logged in user
     * @param $role_id
     */
    public function addRole($role_id)
    {
        $this->roles()->attach($role_id);
    }
}
