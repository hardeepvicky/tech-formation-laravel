<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Route;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) 
        {
            if ($request->ajax() || $request->wantsJson() || $guard == "api") 
            {
                return response([
                    "msg" => "Invalid Api Token",
                    "status" => 0
                ], 401);
            } 
            else 
            {
                return response('Session expired...', 401);
            }
        }
        else
        {
            if (Session::has(ACL_KEY))
            {
                $list = Session::get(ACL_KEY);
                
                //debug($list); exit;
                
                if (!isset($list[$request->method()]))
                {
                    return response('you are not permitted to access this page', 401);
                }
                
                if (!in_array(Route::current()->uri(), $list[$request->method()]))
                {
                    return response('you are not permitted to access this page', 401);
                }
            }
        }

        return $next($request);
    }
}
