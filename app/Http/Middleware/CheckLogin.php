<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\View\Factory as ViewFactory;

class CheckLogin
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
       
        if(!Auth::check()) return redirect('login');
        return $next($request);
    }
}
