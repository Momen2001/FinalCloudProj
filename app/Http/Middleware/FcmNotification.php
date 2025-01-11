<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class FcmNotification
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
        if ($request->hasHeader('fcm_notification')) {
            if (auth('api')->check()) {
                User::query()->find(auth('api')->user()->id)->update(['fcm_notification' => $request->header('fcm-notification')]);
            }
        }

        if ($request->hasHeader('platform')) {
            if (auth('api')->check()) {
                User::query()->find(auth('api')->user()->id)->update(['platform' => $request->header('platform')]);
            }
        }
        return $next($request);
    }
}
