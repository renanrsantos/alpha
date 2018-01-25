<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Authenticate {
    

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest())
        {
            if ($request->ajax())
            {
                return response('Não autorizado.', 401);
            }
            else
            {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}