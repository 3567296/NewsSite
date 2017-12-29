<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const NEED_MODERATE = 1;
    const NEED_AUTH     = 2;

    protected $fillable = ['name', 'slug', 'is_active', 'access_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }

    public function access()
    {
        return $this->hasOne(Access::class, 'id', 'access_id');
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if ($showTimes) {
            $format = $format . " H:i:s";
        }
        return optional($this->created_at)->format($format);
    }
}
