<?php

namespace App\Http\Middleware;

use Closure;

class LoggedInClient
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
        $isLoggedIn = session('logged_in_client');
        if(empty($isLoggedIn) && $isLoggedIn !== true){
            return redirect()->guest('/client/auth');
        }
        return $next($request);
    }
}
