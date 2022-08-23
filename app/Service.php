<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Support\Collection;

class Service extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function packages()
    {
        return $this->hasMany('App\Package');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders(){
        $orders=$this->user->sellings();
        foreach ($orders as $key=>$order){
            if($order->service()->id != $this->getKey()){
                $orders->forget($key);
            }
        }
        return $orders;
    }

    public function reviews(){
        $reviews= new Collection();
        foreach($this->orders() as $order) {
                     if ($order->review){
                $reviews->push($order->review);
            }
            }
        return $reviews;
    }

    public function averageRating(){
        $reviews= $this->reviews(); $average=0; $total=0;
        foreach ($reviews as $review){
            $total++;
            $average+=$review->ratingAverage();
        }
        if($total>0){
            $average=$average/$total;
        }
        return $average;
    }




}
