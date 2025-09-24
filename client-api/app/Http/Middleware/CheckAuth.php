<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('token')) {
            return redirect()->route('auth.index')
                ->withErrors(['error' => 'Por favor inicia sesión para continuar']);
        }

        return $next($request);
    }
}