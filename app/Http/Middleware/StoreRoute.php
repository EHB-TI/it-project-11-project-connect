<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StoreRoute
{
    // public function handle(Request $request, Closure $next)
    // {
    //     $previousRoute = $request->session()->get('currentRoute');

    //     // $previousRoute = $request->route() ? $request->route() : null;
    //     $currentRoute = $request->route() ? $request->route()->getName() : null;

    //     // $currentRoute = $request->route()->getName();

    //     $request->session()->put('previousRoute', $previousRoute);
    //     $request->session()->put('currentRoute', $currentRoute);

    //     return $next($request);
    // }



    // public static function storeRoute(Request $request)
    // {
    //     // $previousRoute = $request->route() ? $request->route() : null;
    //     $previousRoute = $request->session()->get('currentRoute');
    //     $currentRoute = $request->route() ? $request->route()->getName() : null;

    //     $request->session()->put('previousRoute', $previousRoute);
    //     $request->session()->put('currentRoute', $currentRoute);

    //     return $previousRoute;
    // }

    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }


    public static function handle(Request $request, Closure $next)
{
    $currentRoute = $request->route() ? $request->route()->getName() : null;

    // Pass the route name to the controller function
    return $next($request->merge(['currentRoute' => $currentRoute]));
}

public static function  getCurrentRoute(Request $request)
{
    $currentRoute = $request->route() ? $request->route()->getName() : null;

    // Pass the route name to the controller function
    return ($request->merge(['currentRoute' => $currentRoute]));
}

}
?>