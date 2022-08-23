<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class redirectIfAdmin
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
            if($user) {
                if ($user->type == 'admin') {
                    return redirect('\admin');
                }
            }
        return $next($request);
    }
}
