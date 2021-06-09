<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminAuth
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
        session_start();
        if ((!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_email']))) {
            return redirect('/');
        }
        return $next($request);
    }
}
