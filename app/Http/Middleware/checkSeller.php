<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class checkSeller
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

            $user=Auth::User();
            if($user->type!='seller'){
                return abort(404);
            }
        return $next($request);
    }
}