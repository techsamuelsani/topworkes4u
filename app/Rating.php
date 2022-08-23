<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    public function review(){
        return $this->belongsTo('App\Review');
    }
    public function skill(){
        return $this->belongsTo('App\Skill');
    }
}
