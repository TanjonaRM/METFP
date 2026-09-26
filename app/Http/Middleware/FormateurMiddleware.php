<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('formateur')->check()) {
            return redirect()->route('formateur.login')
                ->with('error', 'Veuillez vous connecter en tant que formateur.');
        }

        $formateur = Auth::guard('formateur')->user();

        // Formateur en attente : accès dashboard/profil uniquement
        if ($formateur->statut !== 'actif') {
            $allowedRoutes = [
                'formateur.dashboard',
                'formateur.profile.edit',
                'formateur.profile.show',
                'formateur.profile.update',
                'formateur.profile.password',
                'formateur.logout',
            ];

            $currentRoute = $request->route()?->getName();

            if (!in_array($currentRoute, $allowedRoutes, true)) {
                return redirect()->route('formateur.dashboard')
                    ->with('warning', 'Votre compte est en attente de validation.');
            }
        }

        return $next($request);
    }
}