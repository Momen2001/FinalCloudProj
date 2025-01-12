<?php

namespace App\Http\Middleware;

use Closure;

class ChickPatientAuth
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
        if (auth()->user()->getType() == 'Patient') {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
