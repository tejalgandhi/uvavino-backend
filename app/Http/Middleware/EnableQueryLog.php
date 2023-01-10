<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class EnableQueryLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (debugMode()) {
            DB::enableQueryLog();
        }

        return $next($request);
    }
}
