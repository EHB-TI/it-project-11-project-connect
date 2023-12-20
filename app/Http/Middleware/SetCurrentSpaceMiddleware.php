<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentSpaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $spaceId = $request->input('space_id');

        if (!$spaceId) {
            return redirect()->route('spaces.index');
        }

        session(['current_space_id' => $spaceId]);
    
        return $next($request);
    }
}
