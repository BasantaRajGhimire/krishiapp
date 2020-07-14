<?php

namespace App\Http\Middleware;

use Closure;

class LoggedInServiceProvider
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
        //echo $request->path();exit;
        $isLoggedIn = session('logged_in_seller');
        if(empty($isLoggedIn) && $isLoggedIn !== true){
            return redirect()->guest('/service-provider/auth');
        }
        return $next($request);
    }
}
