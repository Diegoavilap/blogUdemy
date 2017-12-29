<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // func_get_args() es una funcion de php que permite obtener todos los parametros de una funcion
        // array_slice() permite omitir cierta cantidad de parametros 
        $roles = array_slice(func_get_args(), 2);
        
        if (auth()->user()->hasroles($roles)){
            return $next($request);
        }
        
        
        return redirect('/');
    }
}
