<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// ...

Session::put('key', 'value');
class StoreRoute
{
    protected static $currentRouteName;
    protected static $previousRouteName;

    public function handle(Request $request, Closure $next)
    {
        self::$previousRouteName = self::$currentRouteName;
        self::$currentRouteName = $request->route() ? $request->route()->getName() : null;
        
        return $next($request);
        
    }

    public static function getCurrentRouteName()
    {
        Session::put('previousRoute', self::$currentRouteName);
        return self::$currentRouteName;
    }

    public static function getPreviousRouteName()
    {
        return session('previousRoute');
        //return self::$previousRouteName;
    }
}
?>