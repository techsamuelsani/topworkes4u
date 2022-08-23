<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
class checkNotificationRead
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

       $path="/".Request()->path();
       $path=urldecode ($path);
        DB::table('notifications')->where('link',$path)->update(['isSeen' => 1]);
        return $next($request);
    }
}
