<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $localeSession = session('locale');
        $localeSession = $localeSession ?? 'ar';
        App::setLocale($localeSession);
        return $next($request);
    }
}
