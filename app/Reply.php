<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    public function ticket(){
        return $this->belongsTo('App\Ticket');
    }
    public  function user(){
        return $this->belongsTo('App\User');
    }
}
