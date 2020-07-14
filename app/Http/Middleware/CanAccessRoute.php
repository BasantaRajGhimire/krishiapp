<?php

namespace App\Http\Middleware;
use Route;

use Closure;

class CanAccessRoute
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
        $isLoggedIn = session('logged_in');
		$routeName = Route::currentRouteName();
		$canRoute = \App\Role::canRoute($routeName);
        if($canRoute !== true){
           return abort(404);
        }
        return $next($request);
    }
}
