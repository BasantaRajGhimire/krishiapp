<?php

namespace App\Http\Middleware;

use Closure;

class LoggedOutClient
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
        $isLoggedIn = session('logged_in_client');
        if(!empty($isLoggedIn) && $isLoggedIn === true){
            return redirect()->guest('/client');
        }
        return $next($request);
    }
}
