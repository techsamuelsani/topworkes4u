<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Auth;
use App;
class updateOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::Check()){
            $user=Auth::User();
            $user->lastOnline=Carbon::now();
            $user->save();
            $orders=App\Order::all();
            $orders=$orders->where('payment',null);
            foreach ($orders as $order) {
                $order->delete();
            }
        }
        return $next($request);
    }
}
