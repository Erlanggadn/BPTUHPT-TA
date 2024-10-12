<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckKeswanRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $excludedRoutes = [
            'akunadmin/edit/*',
            'akunadmin/update/*',
        ];
    
        foreach ($excludedRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }
        if (Auth::check() && Auth::user()->role == 'keswan') {
            return $next($request);
        }

        return redirect()->route('unauthorized');
    }
}
