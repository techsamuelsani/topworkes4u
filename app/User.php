<?php

namespace App;
use App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','dob','balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function buyings()
    {
        return $this->hasMany('App\Order');
    }

    public function sellings(){
        $sellings=$this->serviceSellings();
        $sellings=$sellings->merge($this->offerSellings);
        return $sellings;
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function offerSellings()
    {
        return $this->hasManyThrough('App\Order','App\Offer');
    }

    public function serviceSellings()
    {
        $orders =App\Order::select('orders.*')->join('packages', 'orders.package_id', '=', 'packages.id')
            ->join('services', 'packages.service_id', '=', 'services.id')
            ->where('services.user_id', $this->getkey())
            ->get();
        return $orders;

    }

    public function recharges()
    {
        return $this->hasMany('App\Recharge');
    }

    public function withdrawals()
    {
        return $this->hasMany('App\Withdrawal');
    }



    public function reviews(){
        $reviews=new Collection();
        foreach ($this->sellings() as $selling){
            if($selling->review){
                $reviews->push($selling->review);
            }
        }
        return $reviews;
    }

public function ifHasPandingWithdrawal(){
        $withdrawal=$this->withdrawals()->where('status','=','Panding')->first();
        if($withdrawal){
            return true;
        }
        return false;
}
    public function averageSkills(){
        $rates=new Collection();
        $reviews=$this->reviews();
        foreach ($reviews as $review){
            foreach ($review->ratings as $rating){
                $rates->push($rating);
            }
        }
        $rates=$rates->groupBy('skill_id');
        $temps=new Collection();
        foreach ($rates as $rateGroup)
        {
            $temp=new customData();
            $num=count($rateGroup); $sum=0;
            foreach ($rateGroup as $rate){
                $sum+=$rate->rating;
                $id=$rate->skill->id;
            }
            $avg=$sum/$num;

            $temp->average=$avg;
            $temp->total=$num;
            $temp->skill_id=$id;
            $temps->push($temp);
        }
        return $temps;
    }

    public function averageRating(){
        $reviews=$this->reviews();
        $total=count($reviews);
        $totalSum=0;
        foreach ($reviews as $review){
            $totalSum+=$review->ratingAverage();
        }
        if($total) {
            return round($totalSum / $total,2);
        }
        return 0;
    }

    public function isOnline(){
        $date=Carbon::parse($this->lastOnline);
        if($date->addMinutes(5)>Carbon::now()){
            return true;
        }
        return false;
    }
}

class customData{
   public $skill_id=null;
   public $total=0;
   public $average=0;
}