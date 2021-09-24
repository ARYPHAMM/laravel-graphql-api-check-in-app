<?php

namespace App\Http\Middleware;

use Closure;

class GraphQL
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
        //  if(auth('sanctum')->user() && (auth('sanctum')->user()->level == 'admin' || auth('sanctum')->user()->level == 'master'))
        //  {
            return $next($request);
        //  }

    }
}
