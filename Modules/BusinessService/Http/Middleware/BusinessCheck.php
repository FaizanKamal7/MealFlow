<?php

namespace Modules\BusinessService\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BusinessCheck
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
        // ALSO HAVE TO ADD TCHECK OF THE USER IS A BUSINES USER

        $businessObj = null;
        if (auth()->check()) {
            // Get the logged-in user's associated business
            $businessObj = auth()->user()->business;
        }

        // Share the business object with all views and controllers
        view()->share('business', $businessObj);

        return $next($request);
    }
}