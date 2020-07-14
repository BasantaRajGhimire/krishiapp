<?php

namespace App\Http\Middleware;

use Closure;

class LoggedOutServiceProvider
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
        $isLoggedIn = session('logged_in_seller');
        if(!empty($isLoggedIn) && $isLoggedIn === true){
            return redirect()->guest('/service-provider');
        }
        return $next($request);
    }
}
