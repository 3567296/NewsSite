<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     * checking user if he has rights to access to BackOffice
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO: need to rebase hasRole method (getting roles from DB)
        if (Auth::check() && Auth::user()->hasRole(['admin', 'editor'])) {
            return $next($request);
        }

        return redirect('/');
    }
}
