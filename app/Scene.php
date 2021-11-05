<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    protected $fillable = [
        'name', 'thumb_img'
    ];

    public function apps()
    {
        return $this->belongsToMany('App\App');
    }
}
