<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Project;

class CheckProjectOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $project = Project::findOrFail($request->id);

        if($request->user()->id !== $project->user_id){
            return redirect()->route('projects.index')->with('error', 'You are not authorized to view this page');
        }
        
        return $next($request);
    }
}
