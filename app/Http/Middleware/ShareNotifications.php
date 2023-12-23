<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Auth;
use View;

class ShareNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $notifications = Auth::user()->notifications()->latest()->get();
        View::share('notifications', $notifications);
    }

    return $next($request);
}

}