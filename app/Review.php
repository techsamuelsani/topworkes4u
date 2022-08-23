<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function ratings(){
        return $this->hasMany('App\Rating');
    }

    public function ratingAverage(){
        $average=0; $totalSum=0;
        $ratings=$this->ratings;
        $total=count($ratings);
        foreach ($ratings as $rating){
            $totalSum+=$rating->rating;
        }
        $average=$totalSum/$total;
        return round($average,2);
    }
}
