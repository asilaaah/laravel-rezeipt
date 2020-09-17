<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Cashier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!FacadesAuth::check()) {
            return redirect()->route('login');
        }

        if (FacadesAuth::user()->role == 2){
            return $next($request);
        }

        $destinations = [
            1 => 'manager',
        ];
        
        return redirect(route($destinations[FacadesAuth::user()->role]));
    }
}
