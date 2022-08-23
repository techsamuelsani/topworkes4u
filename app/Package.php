<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
