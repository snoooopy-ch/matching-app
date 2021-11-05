<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $guarded = ['status'];

    public function category()
    {
        return $this->hasOne('App\Category', 'category_id');
    }

    public function scenes()
    {
        return $this->belongsToMany(Scene::class, 'app_scenes');
    }
}
