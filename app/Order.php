<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    //
    public function buyer()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function seller(){
        if($this->type=="package"){
            return $this->package->service->user;
        }elseif($this->type=="offer"){
            return $this->offer->user;
        }
    }

    public function package(){
        return $this->belongsTo('App\Package');
    }

    public function offer(){
        return $this->belongsTo('App\Offer');
    }

    public function service(){
        if($this->offer) {
            return $this->offer->service;
        }
        return $this->package->service;
    }

    public function payment(){
        return $this->hasOne('App\Payment');
    }
    public function deliveries(){
        return $this->hasMany('App\Delivery');
    }

    public function availableRevisions(){
        if($this->offer) {
            return $this->offer->revisions;
        }
        return $this->package->revisions;
    }

    public function review(){
        return $this->hasOne('App\Review');
    }
    public function lastMonthSum()
    {
        return  DB::table('lastmonth_report')->get();

    }
    public function lastYearSum()
    {
        return  DB::table('yearreport')->get();

    }

}
