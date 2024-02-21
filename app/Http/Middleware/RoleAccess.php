<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {   
        if(!Auth::check()){
            return redirect()->route('login.view');
        }
        foreach ($roles as $role) {
            if(Auth::user()->role == $role){
                return $next($request);
            }
        }
        
        return redirect()->route('home')->witH('error', 'No Access For This Page!');
    }
}
