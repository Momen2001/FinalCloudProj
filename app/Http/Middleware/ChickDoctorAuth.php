<?php

namespace App\Http\Middleware;

use Closure;

class ChickDoctorAuth
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
        if (auth()->user()->getType() == 'Doctor') {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
