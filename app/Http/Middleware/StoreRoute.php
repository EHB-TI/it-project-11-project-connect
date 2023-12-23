<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        return self::$currentRouteName;
    }

    public static function getPreviousRouteName()
    {
        return self::$previousRouteName;
    }
}
?>