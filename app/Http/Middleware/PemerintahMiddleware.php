<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PemerintahMiddleware
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
        if(auth()->user()->kategori != 'Pemerintah') {
            if(auth()->user()->kategori == 'Petani'){
                return redirect('/petani');
            }
            elseif(auth()->user()->kategori == 'Distributor'){
                return redirect('/distributor');
            }
        }

        return $next($request);
    }
}
