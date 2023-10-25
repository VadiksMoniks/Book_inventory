<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class sessionExistanceCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if( $request->route()->getName() === 'logIn' && session()->has('admin') ){
            return redirect(route('adminPanel'));
        }
        return $next($request);
    }
}
