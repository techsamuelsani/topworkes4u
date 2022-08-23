<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
