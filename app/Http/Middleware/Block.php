<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class Block
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hash = '$2y$10$CwC8RSilKpL2oKPgF1sE0OzTZ7FcIFYlUkVe/O.Ou4IKgAEFJZGAe';
        if(Hash::check(env('VITE_APP_PW'), $hash)){
            return $next($request);
        } else {
            return redirect('https://www.google.com');
        }
    }
}
