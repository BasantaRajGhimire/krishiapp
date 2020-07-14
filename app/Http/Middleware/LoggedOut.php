<?php

namespace App\Http\Middleware;

use Closure;

class LoggedOut
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
        $isLoggedIn = session('logged_in');
        if(!empty($isLoggedIn) && $isLoggedIn === true){
            return redirect()->guest('/admin');
        }
        return $next($request);
    }
}
