<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $role = null)
    {
        if (!Auth::check()) {
            return redirect('/');
        } else if ($role && Auth::user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
