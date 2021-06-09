<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class CheckAPIUserToken
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
        if (!User::where('token', $request->token)->exists()) {
            $response_message =  array('success' => false, 'message' => 'Invalid token');
            return response()->json($response_message);
        }
        return $next($request);
    }
}
