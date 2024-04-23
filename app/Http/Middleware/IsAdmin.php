<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            return $next($request);
        }

        // Redirigir al usuario con un mensaje de error
        return redirect('/')->with('error', 'No tienes acceso a esta sección.');
    }
}
