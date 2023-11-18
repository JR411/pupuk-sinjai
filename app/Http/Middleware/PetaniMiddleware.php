<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PetaniMiddleware
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
        if(auth()->user()->kategori != 'Petani') {
            if(auth()->user()->kategori == 'Distributor'){
                return redirect('/distributor');
            }
            elseif(auth()->user()->kategori == 'Pemerintah'){
                return redirect('/pemerintah');
            }
        }

        return $next($request);
    }
}
