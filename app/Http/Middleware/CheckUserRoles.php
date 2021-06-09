<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRoles
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
        $userRole = Session::get('user_role');
         if($userRole == 'admin'){
            return $next($request);
        }else{
            Session::flash('message', 'Unauthorized access'); 
            return redirect()->back();
        }
        
    }
}
