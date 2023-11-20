<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return redirect('/login');
        }
    }
    // public function handle($request, Closure $next, ...$guards)
    // {
    //     if (!auth()->user()) {
    //         if ($request->expectsJson()) {
    //             return response()->json(['error' => 'Unauthenticated.'], 401);
    //         } else {
    //             return redirect('/login');
    //         }
    //     }

    //     return $next($request);
    //     ;
    // }
}
