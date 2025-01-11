<?php

namespace App\Http\Middleware;

use Closure;

class ChickHospitalAuth
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
        if (auth()->user()->getType() == 'Hospital') {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
