<?php

namespace App\Http\Middleware;

use Closure;

class CheckPublisherAuth
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
        if ((!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) && $_SESSION['admin_type'] != 'publisher') {
            return redirect('/');
        }
        return $next($request);
    }
}
