<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User_auth_api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if(\Auth::guard('api')->check()) {
            return $next($request);
        }else{
            $data['status'] = false;
            $data['message'] = \Lang::get('leftsidebar.plz_login');
            return response($data);
        }
    }
}
