<?php

namespace App\Http\Middleware;

use App\Models\TokenMapping;
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
        return route('login_view');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        // if (Auth::guest()) {
        //     if ($request->expectsJson()) {
        //         return response()->json(['error' => 'Unauthenticated.'], 401);
        //     } else {
        //         return redirect('/login');
        //     }
        // }
        // return parent::handle($request, $next, $guards);

        // if ($request->route()->getAction('middleware') === 'api') {
        if (in_array('api', $request->route()->getAction('middleware'))) {
            $token = $request->bearerToken();
            if (!$token || !Auth::guard('api')->check()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            return $next($request);
        } else {
            if (!Auth::guest()) {
                return $next($request);
            } else {
                return redirect('/login');
            }
        }





        // -- Below code is to deal with shorten token
        // $token = $request->bearerToken();

        // if (!$token || !TokenMapping::where('short_token', $token)->exists()) {
        //     // Token is missing or not found in the token_mappings table
        //     return response()->json(['error' => 'Unauthenticated.'], 401);
        // }

        // // Retrieve the original token using the short token
        // $passportToken = TokenMapping::where('short_token', $token)->first()->passport_token_id;
        // $request->headers->set('Authorization', 'Bearer ' . $passportToken);

        // return $next($request);

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
