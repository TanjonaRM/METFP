<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfFormateur
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('formateur')->check()) {
            return redirect()->route('formateur.dashboard');
        }

        return $next($request);
    }
}