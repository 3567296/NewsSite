<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * role ids
     */
    const ADMIN  = 1;
    const EDITOR = 2;
    const USER   = 3;

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
