<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckUserType
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

        if(Auth::user()->usertype == "superAdmin"){

            return $next($request);
        }else{
            return back();
              // abort(403);
        }



    }
}
