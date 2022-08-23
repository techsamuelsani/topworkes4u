<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    public function skills()
    {
        return $this->hasMany('App\Skill');
    }
}
