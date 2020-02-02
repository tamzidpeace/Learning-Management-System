<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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

        $user = Auth::user();
        
        if(!$user->isAdmin()) {
            return redirect('/home')->with('warning', 'Opps! you are not an Admin!');
        }

        return $next($request);
    }
}
